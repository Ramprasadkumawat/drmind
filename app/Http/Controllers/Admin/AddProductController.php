<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
use App\Models\ProductImage;
class AddProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories =  Category::whereNull('parent_id')
                      ->where('type', '!=', 'services')
                      ->get();
        $heading="Add Product";
        return view('admin.ecommerce.add_product',compact('heading','categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
  public function store(Request $request)
{
    $validated = $request->validate([
        'product_name' => 'required|string|max:255',
        'manufacturar_name' => 'required|string|max:255',
        'product_identification_no' => 'required|string|max:255',
        'product_sku' => 'required|string|max:255|unique:products,product_sku',
        'description' => 'required',
        'short_description' => 'required',
        'product_status' => 'required|in:inactive,publish,upcoming,draft',
        'publish_date' => 'required',
        'product_stock' => 'required|integer',
        'level_one' => 'required|integer',
        'level_two' => 'required|integer',
        'level_three' => 'required|integer',
        'earning_point' => 'required|integer',
        'product_category' => 'required|exists:categories,id',
        'base_price' => 'required|numeric',
        'price_currency' => 'required|string|max:3',
        'product_discount_type' => 'required|in:none,fixed,percentage',
        'discount_value' => 'required_if:product_discount_type,fixed,percentage|nullable|numeric|min:0',
        'product_price' => 'required|numeric|min:0',
        'product_shipping' => 'required|in:vendor,drmind',
        'stock_status' => 'required|in:instock,out_of_stock,to_be_announced',
        'images' => 'sometimes|array',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    DB::beginTransaction();

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
            $uploadPath = public_path('product_pdfs');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            $pdfName = time() . '_' . $file->getClientOriginalName();
            $file->move($uploadPath, $pdfName); 
            $relativePdfPath = 'product_pdfs/' . $pdfName; 
            $validated['e_pdf_url'] = $relativePdfPath;
            $validated['e_product'] = "Yes";
        }


        $product = Product::create($validated);

        // Handle image uploads
        if ($request->hasFile('images')) {
            $filenames = [];
            $uploadPath = public_path('product_images');
            
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            foreach ($request->file('images') as $file) {
                if ($file->isValid()) {
                    $filename = time().'_'.$file->getClientOriginalName();
                    $file->move($uploadPath, $filename);
                    
                    // Store relative path in database
                    $relativePath = 'product_images/'.$filename;
                    
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => $relativePath,
                        'image_name' => $filename
                    ]);
                }
            }

        }
        

        DB::commit();
        return redirect()->route('add-product')->with('success', 'Product added successfully!');

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Product creation failed: '.$e->getMessage(), [
            'request_data' => $request->all(),
            'validated_data' => isset($validated) ? $validated : null,
            'exception_trace' => $e->getTraceAsString()
        ]);
        return back()->withInput()->with('error', 'Failed to create product: '.$e->getMessage());
    }
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::where('parent_id', NULL)->get();
        $heading = "Edit Product";
        $product = Product::with('productImages')->findOrFail($id);
        return view('admin.ecommerce.edit_product', compact('heading', 'categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'manufacturar_name' => 'required|string|max:255',
            'product_identification_no' => 'required|string|max:255',
            'product_sku' => 'required|string|max:255|unique:products,product_sku,' . $id,
            'description' => 'required',
            'short_description' => 'required',
            'product_status' => 'required|in:inactive,publish,upcoming,draft',
            'publish_date' => 'required',
            'product_stock' => 'required|integer',
            'level_one' => 'required|integer',
            'level_two' => 'required|integer',
            'level_three' => 'required|integer',
            'earning_point' => 'required|integer',
            'product_category' => 'required|exists:categories,id',
            'base_price' => 'required|numeric',
            'price_currency' => 'required|string|max:3',
            'product_discount_type' => 'required|in:none,fixed,percentage',
            'discount_value' => 'required_if:product_discount_type,fixed,percentage|nullable|numeric|min:0',
            'product_price' => 'required|numeric|min:0',
            'product_shipping' => 'required|in:vendor,drmind',
            'stock_status' => 'required|in:instock,out_of_stock,to_be_announced',
            'images' => 'sometimes|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        DB::beginTransaction();

        try {
            $images = $validated['images'] ?? null;
            unset($validated['images']);

            $validated['publish_date'] = date('Y-m-d', strtotime($validated['publish_date']));
            $validated['tags'] = "'".$request->tags."'" ?? null;
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

            if ($request->hasFile('pdf_file')) {
                $file = $request->file('pdf_file'); 
                $uploadPath = public_path('product_pdfs');
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }
                $pdfName = time() . '_' . $file->getClientOriginalName();
                $file->move($uploadPath, $pdfName); 
                $relativePdfPath = 'product_pdfs/' . $pdfName; 
                $validated['e_pdf_url'] = $relativePdfPath;
            }
          //  dd($validated);
            $product = Product::findOrFail($id);
            $product->update($validated);

            // Handle image uploads if available
            if ($request->hasFile('images')) {
                $uploadPath = public_path('product_images');
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }

                foreach ($request->file('images') as $file) {
                    if ($file->isValid()) {
                        $filename = time() . '_' . $file->getClientOriginalName();
                        $file->move($uploadPath, $filename);

                        $relativePath = 'product_images/' . $filename;

                        ProductImage::create([
                            'product_id' => $product->id,
                            'image_path' => $relativePath,
                            'image_name' => $filename
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('allProducts')->with('success', 'Product updated successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Product update failed: ' . $e->getMessage(), [
                'request_data' => $request->all(),
                'validated_data' => isset($validated) ? $validated : null,
                'exception_trace' => $e->getTraceAsString()
            ]);
            return back()->withInput()->with('error', 'Failed to update product: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // Delete product image via AJAX
    public function productImageDelete(Request $request)
    {
        $id = $request->id;
        if (!$request->ajax()) {
            return response()->json(['success' => false, 'message' => 'Invalid request.'], 400);
        }

        $image = ProductImage::find($id);
        if ($image) {
            $filePath = public_path($image->image_path);
            if (file_exists($filePath)) {
                @unlink($filePath);
            }
            $image->delete();
            return response()->json(['success' => true, 'message' => 'Image deleted successfully.']);
        }
        return response()->json(['success' => false, 'message' => 'Image not found.'], 404);
    }
    function productImageUpdate(Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $image = ProductImage::find($request->id);
        if (!$image) {
            return response()->json(['success' => false, 'message' => 'Image not found.'], 404);
        }

        // Remove old photo from folder
        $oldPath = public_path($image->image_path);
        if (file_exists($oldPath)) {
            @unlink($oldPath);
        }

        // Upload new photo
        $file = $request->file('image');
        $filename = time().'_'.$file->getClientOriginalName();
        $uploadPath = public_path('product_images');
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }
        $file->move($uploadPath, $filename);
        $relativePath = 'product_images/'.$filename;

        // Update database
        $image->image_path = $relativePath;
        $image->image_name = $filename;
        $image->save();

        return response()->json(['success' => true, 'message' => 'Image updated successfully.', 'image_path' => asset($relativePath)]);
    }

    function getsubcategory($id){
        $subcategories = Category::where('parent_id', $id)->get();
        return response()->json($subcategories);
    }

    function allProducts(){
        $products = Product::with('category', 'subcategory','productImages')->get();
        
        //dd($products);
        return view('admin.ecommerce.product_list',compact('products'));
    }
    function eProducts(){
        return view('admin.ecommerce.e_product');
    }
}
