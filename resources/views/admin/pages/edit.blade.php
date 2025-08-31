@extends('admin.layout.template')

@section('content')
<div class="container">
    <h1>Edit Page: {{ $page->name }}</h1>
    <form action="{{ route('pages.update', $page->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select class="form-control" id="category_id" name="category_id" required>
                <option value="">Select a Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $page->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Page Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $page->name) }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $page->slug) }}">
            @error('slug')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="slider_content" class="form-label">Slider Content</label>
            <textarea class="form-control" id="slider_content" name="slider_content" rows="3">{{ old('slider_content', $page->slider_content) }}</textarea>
            @error('slider_content')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="paragraph_content" class="form-label">Paragraph Content</label>
            <textarea class="form-control" id="paragraph_content" name="paragraph_content" rows="5">{{ old('paragraph_content', $page->paragraph_content) }}</textarea>
            @error('paragraph_content')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="images" class="form-label">Upload New Images (optional)</label>
            <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*">
            @error('images.*_paths')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        @if ($page->image_paths)
            <div class="mb-3">
                <label class="form-label">Current Images:</label>
                <div class="row">
                    @foreach (json_decode($page->image_paths) as $imagePath)
                        <div class="col-md-3 mb-2">
                            <img src="{{ asset('storage/' . $imagePath) }}" alt="Page Image" class="img-thumbnail">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="delete_images[]" value="{{ $imagePath }}" id="deleteImage{{ $loop->index }}">
                                <label class="form-check-label" for="deleteImage{{ $loop->index }}">
                                    Delete
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        <button type="submit" class="btn btn-success">Update Page</button>
        <a href="{{ route('pages.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
