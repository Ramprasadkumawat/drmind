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
            'content' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // New homepage fields
            'is_homepage' => 'boolean',
            'slider_text' => 'nullable|string',
            'slider_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'main_paragraph_content' => 'nullable|string',
            'extr-images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $slug = $request->input('slug') ? Str::slug($request->input('slug')) : Str::slug($request->input('name'));

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('public/pages');
                $imagePaths[] = str_replace('public/', '', $path);
            }
        }

        $sliderImagePath = null;
        if ($request->hasFile('slider_image')) {
            $path = $request->file('slider_image')->store('public/homepage/slider');
            $sliderImagePath = str_replace('public/', '', $path);
        }

        $extraImagePaths = [];
        if ($request->hasFile('extr-images')) {
            foreach ($request->file('extr-images') as $extraImage) {
                $path = $extraImage->store('public/homepage/extr-images');
                $extraImagePaths[] = str_replace('public/', '', $path);
            }
        }

        // Handle is_homepage logic: ensure only one page is marked as homepage
        if ($request->has('is_homepage') && $request->is_homepage) {
            Page::where('is_homepage', true)->update(['is_homepage' => false]);
        }

        Page::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => $slug,
            'content' => $request->content,
            'image_paths' => json_encode($imagePaths),
            'is_homepage' => $request->has('is_homepage'),
            'slider_text' => $request->slider_text,
            'slider_image_path' => $sliderImagePath,
            'main_paragraph_content' => $request->main_paragraph_content,
            'extr-image_paths' => json_encode($extraImagePaths),
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
            'content' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'delete_images' => 'nullable|array',
            // New homepage fields
            'is_homepage' => 'boolean',
            'slider_text' => 'nullable|string',
            'slider_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'main_paragraph_content' => 'nullable|string',
            'extr-images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'delete_extr_images' => 'nullable|array',
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

        // Handle slider image
        $sliderImagePath = $page->slider_image_path;
        if ($request->hasFile('slider_image')) {
            // Delete old slider image if it exists
            if ($sliderImagePath) {
                Storage::delete('public/homepage/slider/' . basename($sliderImagePath));
            }
            $path = $request->file('slider_image')->store('public/homepage/slider');
            $sliderImagePath = str_replace('public/', '', $path);
        } else if ($request->input('delete_slider_image')) {
            if ($sliderImagePath) {
                Storage::delete('public/homepage/slider/' . basename($sliderImagePath));
                $sliderImagePath = null;
            }
        }

        // Handle extra images
        $currentExtraImagePaths = json_decode($page->{'extr-image_paths'} ?? '[]', true);
        $newExtraImagePaths = [];

        // Handle extra image deletions
        if ($request->has('delete_extr_images')) {
            foreach ($request->input('delete_extr_images') as $imageToDelete) {
                if (($key = array_search($imageToDelete, $currentExtraImagePaths)) !== false) {
                    Storage::delete('public/' . $imageToDelete);
                    unset($currentExtraImagePaths[$key]);
                }
            }
        }

        // Handle new extra image uploads
        if ($request->hasFile('extr-images')) {
            foreach ($request->file('extr-images') as $extraImage) {
                $path = $extraImage->store('public/homepage/extr-images');
                $newExtraImagePaths[] = str_replace('public/', '', $path);
            }
        }

        $updatedExtraImagePaths = array_merge(array_values($currentExtraImagePaths), $newExtraImagePaths);

        // Handle is_homepage logic: ensure only one page is marked as homepage
        if ($request->has('is_homepage') && $request->is_homepage) {
            Page::where('id', '!=', $page->id)->where('is_homepage', true)->update(['is_homepage' => false]);
        }

        $page->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => $slug,
            'content' => $request->content,
            'image_paths' => json_encode($updatedImagePaths),
            'is_homepage' => $request->has('is_homepage'),
            'slider_text' => $request->slider_text,
            'slider_image_path' => $sliderImagePath,
            'main_paragraph_content' => $request->main_paragraph_content,
            'extr-image_paths' => json_encode($updatedExtraImagePaths),
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
