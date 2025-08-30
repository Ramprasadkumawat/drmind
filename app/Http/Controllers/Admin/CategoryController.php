<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            'category_name' => 'required|string|max:255|unique:categories,name,' . ($request->id ?? 'NULL') . ',id',
        ]);
        if ($request->hasFile('image')) {
            $uploadDir = public_path('assets/img/category');
            if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
            }
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($uploadDir, $imageName);
            $validated['image_path'] = 'assets/img/category/' . $imageName;
        } else {
            $validated['image_path'] = null;
        }
        
        if (isset($request->id)) {
            $msg = "Category Updated successfully";
            $category = Category::findOrFail($request->id);
          //  dd($category); 
            $category->update($validated);
        } else {
            $msg = "Category created successfully";
            Category::create($validated);
        }

        return redirect()->route('categories.index')
            ->with('success', $msg);
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $category->update($request->only('name', 'description'));

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
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
