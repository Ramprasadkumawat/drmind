@extends('home')

@section('content')
<div class="container mt-5">
    @php
        $settingsOrder = json_decode($page->settings_order, true) ?? [];
    @endphp

    @if (empty($settingsOrder))
        {{-- Fallback for pages created before the settings_order feature --}}
        <h1 class="mb-4">{{ $page->name }}</h1>
        @if($page->category)
            <div class="mb-3">
                <strong>Category:</strong> {{ $page->category->name }}
            </div>
        @endif
        @if($page->slug)
            <div class="mb-3 text-muted">
                <small>URL Slug: {{ $page->slug }}</small>
            </div>
        @endif
        @if($page->content)
            <div class="card mb-4">
                <div class="card-header">
                    Page Content
                </div>
                <div class="card-body">
                    {!! $page->content !!}
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
    @else
        @foreach($settingsOrder as $setting)
            @switch($setting)
                @case('name')
                    <h1 class="mb-4">{{ $page->name }}</h1>
                    @break
                @case('category')
                    @if($page->category)
                        <div class="mb-3">
                            <strong>Category:</strong> {{ $page->category->name }}
                        </div>
                    @endif
                    @break
                @case('slug')
                    @if($page->slug)
                        <div class="mb-3 text-muted">
                            <small>URL Slug: {{ $page->slug }}</small>
                        </div>
                    @endif
                    @break
                @case('content')
                    @if($page->content)
                        <div class="card mb-4">
                            <div class="card-header">
                                Page Content
                            </div>
                            <div class="card-body">
                                {!! $page->content !!}
                            </div>
                        </div>
                    @endif
                    @break
                @case('images')
                    @if($page->image_paths)
                        <div class="row mb-4">
                            @foreach(json_decode($page->image_paths) as $imagePath)
                                <div class="col-md-4 mb-3">
                                    <img src="{{ Str::startsWith($imagePath, 'http') ? $imagePath : asset('storage/' . $imagePath) }}" class="img-fluid rounded" alt="{{ $page->name }}">
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @break
                @case('slider')
                     @if($page->slider_image_path)
                        <figure class="figure mb-4">
                            <img src="{{ Str::startsWith($page->slider_image_path, 'http') ? $page->slider_image_path : asset('storage/' . $page->slider_image_path) }}" class="figure-img img-fluid rounded" alt="Slider Image">
                            @if($page->slider_text)
                                <figcaption class="figure-caption">{{ $page->slider_text }}</figcaption>
                            @endif
                        </figure>
                    @endif
                    @break
                @case('main_paragraph')
                    @if($page->main_paragraph_content)
                        <div class="card mb-4">
                            <div class="card-header">
                                Main Content
                            </div>
                            <div class="card-body">
                                {!! $page->main_paragraph_content !!}
                            </div>
                        </div>
                    @endif
                    @break
                @case('extra_images')
                    @if($page->{'extr-image_paths'})
                        <div class="row mb-4">
                            @php
                                $extraImages = json_decode($page->{'extr-image_paths'}, true);
                            @endphp
                            @if(!empty($extraImages))
                                @foreach ($extraImages as $extrImagePath)
                                    <div class="col-md-4 mb-3">
                                        <img src="{{ Str::startsWith($extrImagePath, 'http') ? $extrImagePath : asset('storage/' . $extrImagePath) }}" alt="Extra Image" class="img-fluid rounded">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    @endif
                    @break
            @endswitch
        @endforeach
    @endif

    <a href="{{ route('home.index') }}" class="btn btn-primary">Back to Home</a>
</div>
@endsection
