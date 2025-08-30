<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubscriptionProduct;
use Illuminate\Http\Request;


class ProductsController extends Controller
{
    function products()
    {
        $title = "Products";
        $products = Product::with('productImages','category')->select('id', 'product_name', 'product_category', 'product_subcategory','slug', 'short_description', 'stock_status', 'product_stock')->get();
     // dd($products);
        return view('products', compact('title','products'));
    }
    function productDetails($slug)
    {
        $title = "Product Details";
        $product = Product::with('productImages', 'category', 'subcategory')->where('slug', $slug)->firstOrFail();
        // dd($product);
        return view('product_details', compact('title', 'product'));
    }
    function productsByCategory($slug){
         $title = "Product Details";
         $category = Category::where('slug', $slug)->firstOrFail();
         $products = Product::where('product_category',$category->id)
         ->with('productImages','category')
         ->select('id', 'product_name', 'product_category', 'product_subcategory','slug', 'short_description', 'stock_status', 'product_stock')->get();
        // dd($product);
        return view('category_products', compact('title', 'products'));
    }

    function subscriptionDetails($slug)
    {
       
        $title = "Subscription Details";
        $product = SubscriptionProduct::with('productImages', 'category', 'subcategory')->where('slug', $slug)->firstOrFail();
        
        return view('subscription_product_details', compact('title', 'product'));
    }
}
