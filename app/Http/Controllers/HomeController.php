<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Broadcast;
use App\Models\Testimonial;
use App\Models\Blog;
class HomeController extends Controller
{
   function index()
   {
       $title = "Home";
       $category = Category::where('parent_id',null)->get();
        $categories = Category::where('parent_id', null)->inRandomOrder()->take(3)->get();

        $productTypes = ['Exclusive Products', 'Trending Products', 'New Arrived Products'];
        $data=[];
        foreach ($categories as $index => $cat) {
            $products = $cat->products()->with('productImages')->inRandomOrder()->take(3)->get();

            if ($products->count() === 3) {
                $data[] = [
                    'category' => $cat,
                    'product_type' => $productTypes[$index] ?? 'Products',
                    'products' => $products
                ];

                // Stop after 3 groups are collected
                if (count($data) === 3) {
                    break;
                }
            }
        }
      
       return view('home', compact('title','category','data'));
   }
   function signup()
   {
       $title = "Sign Up";
       return view('signup', compact('title'));
   }
   function createAccount(Request $request){
        $validate = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|min:8|unique:users,email',
            'password' => 'required',
            'referral_code' => [
            'nullable',
            'string',
            'max:10',
            'exists:users,referral_code'
            ],
        ], [
            'reffer_code.exists' => 'referral_code not exist',
        ]);
        if(!empty($validate['referral_code'])){
              $validate['referral_by'] = $validate['referral_code'];
        }
        $validate['referral_code'] = strtoupper(uniqid());
        $validate['name'] = $validate['full_name'];
        $validate['password'] = Hash::make($validate['password']);
        User::create($validate);
        return redirect()->route('user.login')->with('success', 'Account created successfully!');
        
   }
   function login()
   {
       $title = "Login";
       return view('userLogin', compact('title'));
   }

   function about()
   {
       $title = "About Us";
       return view('about', compact('title'));
   }
   function contact()
   {
       $title = "Contact Us";
       return view('contact', compact('title'));
   }
   function faq()
   {
       $title = "FAQ";
       return view('faq', compact('title'));
   }
   function dash(){
    $userId = auth()->id();
    if ($userId) {
        echo "User ID: " . $userId;
    } else {
        echo "No user is logged in.";
    }
   }

   function broadcast(){
        $broadcast = Broadcast::all();
        $title= "Broadcast";
        return view('broadcast',compact('broadcast','title'));
   }
   function subscriptionProducts()
   {
       $title = "Subscription Products";
       $products = \App\Models\SubscriptionProduct::where('product_status','publish')->with('productImages')->get();
       return view('subscription_products', compact('title', 'products'));
   }
   function testimonials(Request $request, $slug=null){
    $title = "Testimonials";
    if($slug){
         $testimonial = Testimonial::where('slug',$slug)->first();
    }else{
        $testimonial = Testimonial::where('status','publish')->first();
    }
    return view('testimonials', compact('title','testimonial'));

   }
   function blogs(){
        $blogslist = Blog::all();
        return view('blogs',compact('blogslist'));
   }
   function blogsdetails(Request $request,$slug){
    $detail = Blog::where('slug',$slug)->first();
    return view('blog-details',compact('detail'));
   }
   function AboutUs()
   {
       $title = "About Us";
       return view('about-us', compact('title'));
   }
   
}
