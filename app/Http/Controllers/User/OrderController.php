<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;

class OrderController extends Controller
{
    function Orders(){
        $orders = Order::where('user_id',Auth::id())->get();
        
        return view('user.ecommerce.order_history',compact('orders'));
    }
    function invoice($orderid){
        $order = Order::where('order_id', $orderid)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        $address = $order->address ?? [];
        if (is_string($address)) {
            $address = json_decode($address, true);
            if (is_string($address)) {
                $address = json_decode($address, true);
            }
        }
        $products = $order->products ?? [];
        if (is_string($products)) {
            $products = json_decode($products, true);
            if (is_string($products)) {
                $products = json_decode($products, true);
            }
        }
     
      return view('user.ecommerce.invoice',compact('order','products','address'));
    }
}
