<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Product;
use App\Models\Cart;

class Authentication extends Controller
{
   function index(){
     return view('login');
   }

function login(Request $request){
       $request->validate([
               'email' => 'required|email',
               'password' => 'required',
       ]);
       if(Auth::guard(name: 'admin')->attempt($request->only('email', 'password'))){
               $admin = Auth::guard('admin')->user();
               return redirect()->route('admin.dashboard');
       }
       return back()->with('error', 'Invalid email or password.');
}
     public function UserLogin(Request $request)
     {
     // Debug session at start
     \Log::debug('LoginController Initial Session:', session()->all());

     $credentials = $request->validate([
          'email' => 'required|email|min:8',
          'password' => 'required',
     ]);

     if (auth()->attempt($credentials)) {
          $request->session()->regenerate();
          
    

          if ($request->hasCookie('pending_cart')) { // this part not working need to check 
               \Log::debug('cokkies find', $request->cookie('pending_cart'));
               $cartData = json_decode($request->cookie('pending_cart'), true);
               
               // Process cart data
               Cart::updateOrCreate(
                    ['user_id' => auth()->id(), 'product_id' => $cartData['product_id']],
                    ['quantity' => \DB::raw('quantity + 1')]
               );
               
               $redirectUrl = $cartData['intended_url'] ?? route('cart.show');
               
               return redirect($redirectUrl)
                         ->with('success', 'Product added to your cart')
                         ->withoutCookie('pending_cart');
          }

          return redirect()->route('home.index')
                         ->with('success', 'Login successful');
     }

     return back()->with('error', 'Invalid username or password.');
     }
     function logout(Request $request){
          auth()->logout();
          $request->session()->invalidate();
          $request->session()->regenerateToken();
          return redirect()->route('user.login');
     }
}
