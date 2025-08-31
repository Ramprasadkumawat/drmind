@extends('admin.layout.template')

@section('content')
<div class="container">
    <h1>Page Details: {{ $page->name }}</h1>

    <div class="card mb-3">
        <div class="card-header">Page Information</div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $page->id }}</p>
            <p><strong>Category:</strong> {{ $page->category->name ?? 'N/A' }}</p>
            <p><strong>Name:</strong> {{ $page->name }}</p>
            <p><strong>Slug:</strong> {{ $page->slug }}</p>
            <p><strong>Slider Content:</strong></p>
            <div class="border p-3">{!! nl2br(e($page->slider_content)) !!}</div>
            <p class="mt-3"><strong>Paragraph Content:</strong></p>
            <div class="border p-3">{!! nl2br(e($page->paragraph_content)) !!}</div>
        </div>
    </div>

    @if ($page->image_paths)
        <div class="card mb-3">
            <div class="card-header">Images</div>
            <div class="card-body">
                <div class="row">
                    @foreach (json_decode($page->image_paths) as $imagePath)
                        <div class="col-md-4 mb-3">
                            <img src="{{ asset('storage/' . $imagePath) }}" alt="Page Image" class="img-fluid img-thumbnail">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-warning">Edit Page</a>
    <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">Back to Pages</a>
</div>
@endsection
