<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Checkout\Session as CheckoutSession;
use Laravel\Cashier\Cashier;
use App\Models\UserSubscription;
use App\Models\SubscriptionProduct as Product;
use Auth;

class SubscriptionController extends Controller
{
   public function createCheckoutSession(Request $request)
    {
        $user = Auth()->user();
        if(!$user) {
            return redirect()->route('user.login')->with('error', 'You must be logged in to subscribe.');
        }
        $productId = $request->product_id;
        $product = Product::findOrFail($productId);
        if(!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }
        $stripePriceId = $product->stripe_price_id;
       
        $checkoutSession = $user->newSubscription('default',$stripePriceId) // replace with actual price ID
            ->checkout([
                'success_url' => route('subscribe.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('subscribe.cancel'),
            ]);

        return redirect($checkoutSession->url);
    }
   public function success(Request $request)
{
    $user = auth()->user();
    $sessionId = $request->get('session_id');
    \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
    $session = \Stripe\Checkout\Session::retrieve($sessionId);
    $subscriptionId = $session->subscription;

    $subscription = \Stripe\Subscription::retrieve($subscriptionId);

    $priceId = $subscription->items->data[0]->price->id;

    $product = Product::where('stripe_price_id', $priceId)->first();

    if ($session->payment_status === 'paid') {
        Log::info('Payment successful for session ID: ' . $sessionId);

        UserSubscription::create([
            'user_id' => $user->id,
            'product_id' => $product->id ?? null,
            'invoice_number' => $session->invoice,
            'type' => 'subscription',
            'stripe_id' => $subscriptionId,
            'stripe_status' => $subscription->status,
            'stripe_price' => $priceId,
            'product_price' => $product->monthly_price ?? 0,
            'quantity' => 1, // Assuming quantity is 1 for subscriptions
            'plan_name' => $product->product_name ?? 'E-book Plan',
            'starts_at' => \Carbon\Carbon::createFromTimestamp($subscription->current_period_start),
            'ends_at' => \Carbon\Carbon::createFromTimestamp($subscription->current_period_end),
        ]);

        return redirect()->route('user-dashboard')->with('success', 'Subscription successful!');
    }

    return redirect()->route('user-dashboard')->with('error', 'Payment failed or canceled.');
}

}
