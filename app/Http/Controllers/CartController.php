<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\log;
use App\Models\Order;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Exception\CardException;


class CartController extends Controller
{
    public function addToCart(Request $request)
    {
       $validate = $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);
        if (!Auth::check()) {
            $cartData = json_encode([
                'product_id' => $validate['product_id'],
                'intended_url' => url()->previous()
            ]);

            // Proper logging
            Log::channel('single')->debug('CartController addToCart - Pending Cart Cookie Set', [
                'cookie_data' => $cartData,
                'time' => now(),
                'ip' => request()->ip()
            ]);

            return redirect()
                ->route('login')
                ->with('info', 'Please login to add items to your cart')
                ->cookie('pending_cart', $cartData, 5);
        }

        
        $product = Product::findOrFail($validate['product_id']);
        $user = Auth::user();
      
        $cartItem = Cart::where('user_id', $user->id)
            ->where('product_id', $validate['product_id'])
            ->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $validate['product_id'],
                'quantity' => 1
            ]);
        }

        return redirect()->route('cart.show')->with('success', 'Product added to cart');
    }
    function cartProducts()
    {
        $title = "Cart Products";
        $cartItems = Cart::withProductAndUserDetails()
            ->where('user_id', Auth::id())
            ->get();
       // dd($cartItems);
        if ($cartItems->isEmpty()) {
            return redirect()->route('home.index')->with('info', 'Your cart is empty');
        }

        return view('cart_products', compact('title', 'cartItems'));
    }

    public function updateQuantity(Request $request)
    {
        
        $cartItem = Cart::with('product')->find($request->id);
       
        if (!$cartItem) {
            return response()->json(['success' => false]);
        }

        if ($request->action === 'increase' && $cartItem->quantity <= $cartItem->product->product_stock) {
            $cartItem->quantity += 1;
        } elseif ($request->action === 'decrease' && $cartItem->quantity > 1) {
            $cartItem->quantity -= 1;
        }

       
        $cartItem->save();

        // Recalculate subtotal, tax, total
        $cartItems = Cart::with('product')->get();
        $subtotal = $cartItems->sum(fn($item) => $item->product->product_price * $item->quantity);
        $shipping = 10;
        $tax = $subtotal * 0.1;
        $total = $subtotal + $shipping + $tax;

        return response()->json([
            'success' => true,
            'itemQty' => $cartItem->quantity,
            'itemPrice' => number_format($cartItem->product->product_price * $cartItem->quantity, 2),
            'subtotal' => number_format($subtotal, 2),
            'tax' => number_format($tax, 2),
            'total' => number_format($total, 2),
        ]);
    }

    public function removeItem(Request $request)
    {
        $cartItem = Cart::find($request->id);

        if ($cartItem) {
            $cartItem->delete();
        }

        $cartItems = Cart::with('product')->get();
        $subtotal = $cartItems->sum(fn($item) => $item->product->product_price * $item->quantity);
        $shipping = 10;
        $tax = $subtotal * 0.1;
        $total = $subtotal + $shipping + $tax;

        return response()->json([
            'success' => true,
            'subtotal' => number_format($subtotal, 2),
            'tax' => number_format($tax, 2),
            'total' => number_format($total, 2),
        ]);
    }

    function checkout()
    {
        $title = "Checkout";
        $cartItems = Cart::withProductAndUserDetails()
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('products.allproduct')->with('info', 'Your cart is empty');
        }

        $subtotal = $cartItems->sum(fn($item) => $item->product->product_price * $item->quantity);
        $shipping = 10;
        $tax = $subtotal * 0.1;
        $total = $subtotal + $shipping + $tax;

        return view('checkout', compact('title', 'cartItems', 'subtotal', 'shipping', 'tax', 'total'));
    }

}