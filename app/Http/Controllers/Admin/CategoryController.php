<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $categories = Category::latest()->get();
        return view('admin.ecommerce.category', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        
        $categories = Category::where('parent_id', NULL)->get();
        return view('admin.ecommerce.category',compact('categories'));
    }
    function subcategoryCreate($id=null)
    {
        
        $formData = null;
        if(isset($id)){
            $formData = Category::findOrFail($id);
           
        }
        $categories = Category::where('parent_id', NULL)->get();
        // Fetch all categories that are not subcategories

        $subcategories = Category::whereNotNull('parent_id')
        ->with('parent')
        ->get();
        
        return view('admin.ecommerce.subcategory',compact('categories','subcategories','formData'));
    }
    function subcategoryStore(Request $request)
    {
        
        $validated = $request->validate([
            'sub_category_name' => 'required|string|max:255|unique:categories,name',
            'category_id' => 'required|exists:categories,id',
        ]);
        $msg="Subcategory created successfully!";
        if ($request->id) {
            $subcategory = Category::findOrFail($request->id);
            $subcategory->update([
            'name' => $validated['sub_category_name'], // Maps form field to DB column
            'parent_id' => $validated['category_id'],
            ]);
            $msg="Subcategory updated successfully!";
        } else {
            Category::create([
            'name' => $validated['sub_category_name'], // Maps form field to DB column
            'parent_id' => $validated['category_id'],
            ]);
        }
       

        return redirect()->route('subcategory.create')
            ->with('success', $msg);

    }
    function subcategorydestroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('subcategory.create')
            ->with('success', 'Subcategory deleted successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'type' => 'required|in:physical,e-product,services',
            'category_name' => 'required|string|max:255|unique:categories,name',
            'slug' => 'nullable|string|max:255|unique:categories,slug',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $slug = $validated['slug'] ? Str::slug($validated['slug']) : Str::slug($validated['category_name']);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('public/categories');
            $imagePath = str_replace('public/', '', $path);
        }

        Category::create([
            'type' => $validated['type'],
            'name' => $validated['category_name'],
            'slug' => $slug,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // Fetch all categories for the list
        $categories = Category::latest()->get();
        // Pass both the list and the single category to the view
        return view('admin.ecommerce.category', compact('categories', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'type' => 'required|in:physical,e-product,services',
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'slug' => 'nullable|string|max:255|unique:categories,slug,' . $category->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'delete_image' => 'nullable|boolean',
        ]);

        $slug = $validated['slug'] ? Str::slug($validated['slug']) : Str::slug($validated['name']);

        $imagePath = $category->image_path;

        // Handle image deletion
        if ($request->has('delete_image') && $request->input('delete_image') && $imagePath) {
            Storage::delete('public/' . $imagePath);
            $imagePath = null;
        }

        // Handle new image upload
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($category->image_path) {
                Storage::delete('public/' . $category->image_path);
            }
            $image = $request->file('image');
            $path = $image->store('public/categories');
            $imagePath = str_replace('public/', '', $path);
        }

        $category->update([
            'type' => $validated['type'],
            'name' => $validated['name'],
            'slug' => $slug,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->image_path) {
            Storage::delete('public/' . $category->image_path);
        }
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully.');
    }

    /**
     * Restore the specified resource from trash.
     */
    public function restore($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $category->restore();

        return redirect()->route('categories.index')
            ->with('success', 'Category restored successfully.');
    }

    /**
     * Permanently delete the specified resource from storage.
     */
    public function forceDelete($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $category->forceDelete();

        return redirect()->route('categories.index')
            ->with('success', 'Category permanently deleted.');
    }
}
