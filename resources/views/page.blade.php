@extends('home')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">{{ $page->name }}</h1>

    @if($page->slider_content)
        <div class="card mb-4">
            <div class="card-header">
                Slider Content
            </div>
            <div class="card-body">
                {!! $page->slider_content !!}
            </div>
        </div>
    @endif

    @if($page->paragraph_content)
        <div class="card mb-4">
            <div class="card-header">
                Page Content
            </div>
            <div class="card-body">
                {!! $page->paragraph_content !!}
            </div>
        </div>
    @endif

    @if($page->image_paths)
        <div class="row mb-4">
            @foreach(json_decode($page->image_paths) as $imagePath)
                <div class="col-md-4 mb-3">
                    <img src="{{ Str::startsWith($imagePath, 'http') ? $imagePath : asset('storage/' . $imagePath) }}" class="img-fluid rounded" alt="{{ $page->name }}">
                </div>
            @endforeach
        </div>
    @endif

    <a href="{{ route('home.index') }}" class="btn btn-primary">Back to Home</a>
</div>
@endsection
