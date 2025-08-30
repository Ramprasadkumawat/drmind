<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\EarningRecord;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session as CheckoutSession;
use Stripe\Exception\CardException;
use Stripe\Exception\RateLimitException;
use Stripe\Exception\InvalidRequestException;
use Stripe\Exception\AuthenticationException;
use Stripe\Exception\ApiConnectionException;
use Stripe\Exception\ApiErrorException;
use App\Models\Order;

class MakePaymentController extends Controller
{
    public function processCheckout(Request $request)
    {
        $validated = $this->validateCheckoutRequest($request);

        try {
            Stripe::setApiKey(config('services.stripe.secret'));

            $total = $this->calculateCartTotal();
            if ($total <= 0) {
                return back()->withErrors('Your cart is empty or total amount is zero.');
            }

            $checkoutSession = $this->createStripeCheckoutSession($total,$request);

            return redirect($checkoutSession->url);

        } catch (CardException $e) {
            return $this->handleStripeException($e, 'Stripe Checkout Error', 'Error processing payment: ');
        } catch (InvalidRequestException $e) {
            return $this->handleStripeException($e, 'Stripe Invalid Request', 'Invalid payment request. Please try again.');
        } catch (RateLimitException $e) {
            return $this->handleStripeException($e, 'Stripe Rate Limit', 'Too many payment attempts. Please wait and try again.');
        } catch (AuthenticationException $e) {
            return $this->handleStripeException($e, 'Stripe Authentication Error', 'Payment processing error. Please contact support.');
        } catch (ApiConnectionException $e) {
            return $this->handleStripeException($e, 'Stripe API Connection Error', 'Network error processing payment. Please try again.');
        } catch (ApiErrorException $e) {
            return $this->handleStripeException($e, 'Stripe API Error', 'Payment processing error. Please try again.');
        } catch (\InvalidArgumentException $e) {
            return back()->withErrors($e->getMessage());
        } catch (\Exception $e) {
            Log::critical('Checkout Process Error: ' . $e->getMessage(), [
                'user_id'   => Auth::id(),
                'exception' => get_class($e),
                'trace'     => $e->getTraceAsString(),
            ]);
            return back()->withErrors('An unexpected error occurred. Please try again later.');
        }
    }

    private function createStripeCheckoutSession($total,$request)
    {
        // Prepare detailed product data for metadata
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        $products = [];
      
        foreach ($cartItems as $item) {
            if ($item->product) {
                $products[] = [
                    'product_id'   => $item->product->id,
                    'quantity'     => $item->quantity,
                    'product_price'=> $item->product->product_price,
                    'product_name' => $item->product->product_name,
                    'earning_point'=> $item->product->earning_point,
                    'level_one'    => $item->product->level_one,
                    'level_two'    => $item->product->level_two,
                    'level_three'  => $item->product->level_three
                ];
            }
        }

        return CheckoutSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                'name' => 'Your Cart Total',
                ],
                'unit_amount' => $total * 100, // amount in cents
            ],
            'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.cancel'),
            'customer_email' => Auth::user()->email,
            'metadata' => [
            'user_id' => Auth::id(),
            'address' => json_encode($this->prepareAddressData($request)),
            'products' => json_encode($products),
            ],
        ]);
        
    }

    private function handleStripeException($e, $logMessage, $userMessage)
    {
        Log::error($logMessage . ': ' . $e->getMessage(), [
            'user_id' => Auth::id(),
            'exception' => get_class($e),
            'trace' => $e->getTraceAsString(),
        ]);
        return back()->withErrors(is_string($userMessage) ? $userMessage . ($e instanceof CardException ? $e->getMessage() : '') : $userMessage);
    }

    private function calculateCartTotal()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();
        $subtotal = $cartItems->sum(fn($item) => $item->product->product_price * $item->quantity);
        $shipping = 10;
        $tax      = $subtotal * 0.1;
        $total    = $subtotal + $shipping + $tax;
        return $total;
    }

    /**
     * Validate the checkout request.
     *
     * @param Request $request
     * @return array
     */
    private function validateCheckoutRequest(Request $request)
    {
        return $request->validate([
            'firstName'     => 'required|string|max:255',
            'lastName'      => 'required|string|max:255',
           // 'username'      => 'required|string|max:255',
            'email'         => 'nullable|email|max:255',
            'address'       => 'required|string|max:255',
            'address2'      => 'nullable|string|max:255',
            'country'       => 'required|string|max:255',
            'state'         => 'required|string|max:255',
            'zip'           => 'required|string|max:255',
        ]);
    }

    

    private function prepareAddressData(Request $request)
    {
        return [
            'first_name'      => $request->firstName,
            'last_name'       => $request->lastName,
            'address1'        => $request->address,
            'address2'        => $request->address2,
            'phone'           => $request->phone ?? null,
            'country'         => $request->country,
            'state'           => $request->state,
            'zip'             => $request->zip,
            'same_as_billing' => $request->has('same_address'),
        ];
    }

   
    public function clearCart()
    {
        Cart::where('user_id', Auth::id())->delete();

        Log::channel('single')->info('Cart cleared after successful payment', [
            'user_id' => Auth::id(),
            'time'    => now(),
            'ip'      => request()->ip(),
        ]);
    }

    public function checkoutSuccess(Request $request)
    {
        
        Stripe::setApiKey(config('services.stripe.secret'));

        $sessionId = $request->get('session_id');
        if (!$sessionId) {
            return redirect()->route('cart')->withErrors('Session ID missing from Stripe response.');
        }

        $session = CheckoutSession::retrieve($sessionId);

        log::info('Checkout Success: ' . now(), [
            'user_id' => Auth::id(),
            'session_id' => $request->get('session_id'),
            'data' => json_encode($request->all()),
            'session' => json_encode($session),
        ]);

        if ($session->payment_status !== 'paid') {
            return redirect()->route('cart')->withErrors('Payment was not successful.');
        }
    
      
        $total = $this->calculateCartTotal();
        $addressData = json_decode($session->metadata->address, true);
        $order = $this->createOrder($session, $total, $addressData);
        $this->updateProductStock();
        $this->clearCart();
        if(isset($session->metadata->products)){
            $this->CreateEarningReport($session->metadata->products,$order['id']);
        }
        return view('success', compact('order'));
    }
    private function createOrder($session, $total, $addressData)
{
    $order = Order::create([
        'user_id'       => Auth::id(),
        'order_id'      => 'ORD-' . strtoupper(uniqid()),
        'payment_method'=> 'stripe',
        'payment_mode' => $session->payment_method_types[0] ?? 'card',
        'stripe_id'     => $session->id,
        'payment_intent_id'=> $session->payment_intent,
        'payment_status'=> $session->payment_status,
        'status'        => 'paid',
        'currency'      => $session->currency,
        'amount'        => $total,
        'earing_point'  => $session->earning_point,
        'level_one'     => $session->level_one,
        'level_two'     => $session->level_two,
        'level_three'   => $session->level_three,
        'shipping_amount'=>0.00,
        'tax_amount'    => 0.00, // Assuming no tax for simplicity
        'email'         => $session->customer_email,
        'customer_name' => $session->customer_details->name,
        'address'       => json_encode($addressData),
        'products'    => json_encode($session->metadata->products ?? []),
    ]);

    return [
        'id'       => $order->id,
        'order_id' => $order->order_id,
        ];
}

    function updateProductStock(){
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
            foreach ($cartItems as $item) {
                if ($item->product) {
                    $item->product->decrement('product_stock', $item->quantity);
                }
            }
    }


   function CreateEarningReport($data,$order_id)
    {
        $session = json_decode($data);
        
        $earningPoint=0;
        $levelOnePoint=0;
        $levelTwoPoint=0;
        $levelThreePoint=0;

        if(!empty($session)){
            foreach($session as $row){
                $earningPoint+= $row->earning_point;
                $levelOnePoint+= $row->level_one;
                $levelTwoPoint+= $row->level_two;
                $levelThreePoint+= $row->level_three;
            }
          
            $id = Auth::id();
            $user = User::select('referral_code', 'earning_point', 'level_earning', 'referral_by')->where('id', $id)->first();
            $selfCode = $user->referral_code;

            if ($user) {
                $earningPointAmount = (float) $user->earning_point + $earningPoint;
                User::where('id', $id)->update(['earning_point' => $earningPointAmount]);
                EarningRecord::create([
                    'user_id'       => $selfCode,
                    'from_user'     => null,
                    'meta_tag'      => 'self',
                    'earning_point' => $earningPoint,
                    'order_id'      => $order_id
                ]);
            }
            if ($levelOnePoint) {
                $levelOneAmount = (float) $user->level_earning + $levelOnePoint;
                User::where('id', $id)->update(['level_earning' => $levelOneAmount]);

                EarningRecord::create([
                    'user_id'       => $selfCode,
                    'from_user'     => null,
                    'meta_tag'      => 'self_level_one',
                    'earning_point' => $levelOnePoint,
                     'order_id'      => $order_id
                ]);
            }

            // Level Two
            $levelTwo = User::select('referral_by')->where('id', $id)->first();
            if (!empty($levelTwo->referral_by)) {
                $getLevelTwoData = User::select('id','level_earning')->where('referral_code',$levelTwo->referral_by)->first();
                $levelTwoAmount = $levelTwoPoint;
               if ($getLevelTwoData) {
                    User::where('id', $getLevelTwoData->id)
                        ->update([
                            'level_earning' => ($getLevelTwoData->level_earning ?? 0) + $levelTwoAmount
                        ]);
                }
                EarningRecord::create([
                    'user_id'       => $levelTwo->referral_by,
                    'from_user'     => $selfCode,
                    'meta_tag'      => 'level_two',
                    'earning_point' => $levelTwoAmount,
                     'order_id'      => $order_id
                ]);
                $levelThree = User::select('referral_by')->where('referral_code', $levelTwo->referral_by)->first();
                if (!empty($levelThree->referral_by)) {
                    $getLevelThreeData = User::select('id','level_earning')->where('referral_code',$levelThree->referral_by)->first();
                    $levelThreeAmount = $levelThreePoint;
                    if ($getLevelThreeData) {
                        User::where('id', $getLevelThreeData->id)
                            ->update([
                                'level_earning' => ($getLevelThreeData->level_earning ?? 0) + $levelThreeAmount
                            ]);
                    }

                    EarningRecord::create([
                        'user_id'       => $levelThree->referral_by,
                        'from_user'     => $selfCode,
                        'meta_tag'      => 'level_three',
                        'earning_point' => $levelThreeAmount,
                        'order_id'      => $order_id
                    ]);
                }
            }
        }
    }

    function checkoutCancel(){
        return redirect()->route('home.index');
    }
    
}
