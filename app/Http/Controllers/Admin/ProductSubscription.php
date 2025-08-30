<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Category;
use App\Models\SubscriptionProduct;
use App\Models\SubscriptionProductImage;
use Stripe\Stripe;
use Stripe\Product;
use Stripe\Price;

class ProductSubscription extends Controller
{
    function addSubscriptionProduct(){
         $categories =  Category::whereNull('parent_id')
                      ->where('type', 'services')
                      ->get();
        $heading="Add Subscription Product";
        return view('admin.ecommerce.add_product_subscription',compact('categories','heading'));
    }
    function createProductSubscription(Request $request){
         $validated = $request->validate([
        'product_name' => 'required|string|max:255',
        //'manufacturar_name' => 'required|string|max:255',
        'product_identification_no' => 'required|string|max:255',
        'product_sku' => 'required|string|max:255|unique:products,product_sku',
        'description' => 'required',
        'short_description' => 'required',
        'product_status' => 'required|in:inactive,publish,upcoming,draft',
        'publish_date' => 'required',
        'product_category' => 'required|exists:categories,id',
        'monthly_price' => 'required|numeric',
        'price_currency' => 'required|string|max:3',
        //'product_discount_type' => 'required|in:none,fixed,percentage',
        //'discount_value' => 'required_if:product_discount_type,fixed,percentage|nullable|numeric|min:0',
        //'product_price' => 'required|numeric|min:0',
        'images' => 'sometimes|array',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    DB::beginTransaction();
    \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    try {
        $images = $validated['images'] ?? null;
        unset($validated['images']);
  

        $validated['publish_date'] = date('Y-m-d', strtotime($validated['publish_date']));
        $validated['tags'] = $request->tags ?? null ;
        $label = null;
            if (isset($request->specification_terms) && isset($request->specification_property)) {
                $terms = array_filter($request->specification_terms, function($v) { return !is_null($v) && $v !== ''; });
                $properties = array_filter($request->specification_property, function($v) { return !is_null($v) && $v !== ''; });
                // Ensure both arrays have the same number of elements
                $terms = array_values($terms);
                $properties = array_values($properties);
                $count = min(count($terms), count($properties));
                $label = json_encode(array_combine(array_slice($terms, 0, $count), array_slice($properties, 0, $count)));
            }
        $validated['specification_terms'] = $label;
        // Create product first to get ID

       if ($request->hasFile('pdf_file')) {
            $file = $request->file('pdf_file'); 
            $uploadPath = public_path('product_subscription_pdfs');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            $pdfName = time() . '_' . $file->getClientOriginalName();
            $file->move($uploadPath, $pdfName); 
            $relativePdfPath = 'product_subscription_pdfs/' . $pdfName; 
            $validated['e_pdf_url'] = $relativePdfPath;
            $validated['e_product'] = "Yes";
        }

        
            $stripeProduct = Product::create([
                'name' => $request->product_name, // e.g., "E-book Basic Plan"
            ]);

            $stripePrice = Price::create([
                'unit_amount' => $request->monthly_price * 100, // in cents: $10 => 1000
                'currency' => 'usd',
                'recurring' => ['interval' => 'month'], // or 'year'
                'product' => $stripeProduct->id,
            ]);
        if (!$stripeProduct || !$stripePrice) {
            throw new \Exception('Failed to create Stripe product or price.');
        }
        $validated['stripe_product_id'] = $stripeProduct->id;
        $validated['stripe_price_id'] = $stripePrice->id;
        $product = SubscriptionProduct::create($validated);

        // Handle image uploads
        if ($request->hasFile('images')) {
            $filenames = [];
            $uploadPath = public_path('product_subscription_images');
            
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            foreach ($request->file('images') as $file) {
                if ($file->isValid()) {
                    $filename = time().'_'.$file->getClientOriginalName();
                    $file->move($uploadPath, $filename);
                    
                    // Store relative path in database
                    $relativePath = 'product_subscription_images/'.$filename;
                    
                    SubscriptionProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => $relativePath,
                        'image_name' => $filename
                    ]);
                }
            }

        }
        

        DB::commit();
        return redirect()->route('add-product-subscription')->with('success', 'Product Subscription created successfully!');

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Subscription Product creation failed: '.$e->getMessage(), [
            'request_data' => $request->all(),
            'validated_data' => isset($validated) ? $validated : null,
            'exception_trace' => $e->getTraceAsString()
        ]);
        return back()->withInput()->with('error', 'Failed to create product: '.$e->getMessage());
    }
    }

    function allSubscriptionProducts(){
        $heading="All Subscription Products";
        $products = SubscriptionProduct::with('category', 'subcategory', 'productImages')->get();
       // dd($products);
        return view('admin.ecommerce.all_subscription_products', compact('products', 'heading'));
    }
}
