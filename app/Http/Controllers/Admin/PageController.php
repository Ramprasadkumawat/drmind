<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Page::with('category')->get();
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.pages.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:pages,slug',
            'slider_content' => 'nullable|string',
            'paragraph_content' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $slug = $request->input('slug') ? Str::slug($request->input('slug')) : Str::slug($request->input('name'));

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('public/pages');
                $imagePaths[] = str_replace('public/', '', $path);
            }
        }

        Page::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => $slug,
            'slider_content' => $request->slider_content,
            'paragraph_content' => $request->paragraph_content,
            'image_paths' => json_encode($imagePaths),
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        return view('admin.pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        $categories = Category::all();
        return view('admin.pages.edit', compact('page', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:pages,slug,' . $page->id,
            'slider_content' => 'nullable|string',
            'paragraph_content' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'delete_images' => 'nullable|array',
        ]);

        $slug = $request->input('slug') ? Str::slug($request->input('slug')) : Str::slug($request->input('name'));

        $currentImagePaths = json_decode($page->image_paths ?? '[]', true);
        $newImagePaths = [];

        // Handle image deletions
        if ($request->has('delete_images')) {
            foreach ($request->input('delete_images') as $imageToDelete) {
                if (($key = array_search($imageToDelete, $currentImagePaths)) !== false) {
                    Storage::delete('public/' . $imageToDelete);
                    unset($currentImagePaths[$key]);
                }
            }
        }

        // Handle new image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('public/pages');
                $newImagePaths[] = str_replace('public/', '', $path);
            }
        }

        $updatedImagePaths = array_merge(array_values($currentImagePaths), $newImagePaths);

        $page->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => $slug,
            'slider_content' => $request->slider_content,
            'paragraph_content' => $request->paragraph_content,
            'image_paths' => json_encode($updatedImagePaths),
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        if ($page->image_paths) {
            foreach (json_decode($page->image_paths) as $imagePath) {
                Storage::delete('public/' . $imagePath);
            }
        }
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully.');
    }

    /**
     * Toggle the publish status of the specified page.
     */
    public function publish(Page $page)
    {
        $page->is_published = !$page->is_published;
        $page->save();

        $message = $page->is_published ? 'published' : 'unpublished';
        return redirect()->route('admin.pages.index')->with('success', "Page {$page->name} has been {$message} successfully.");
    }
}
