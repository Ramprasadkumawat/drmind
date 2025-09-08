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
                <strong>Popular Category:</strong> {{ $page->category->name }}
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
                @foreach($page->image_paths as $imagePath)
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
                    @if($page->categories()->isNotEmpty())
                        <div class="mb-4">
                            <h5 class="text-center new-font-style">Popular Category</h5>
                            <div class="row justify-content-center">
                                @foreach($page->categories() as $category)
                                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4 text-center">
                                        <span>{{ $category->name }}</span>
                                        @if($category->image_path)
                                            <img src="{{ asset($category->image_path) }}" alt="{{ $category->name }}" class="img-fluid rounded mb-2" style="height: 150px; width: 100%; object-fit: cover;">
                                        @endif
                                    </div>
                                @endforeach
                            </div>
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
                            @foreach($page->image_paths as $imagePath)
                                <div class="col-md-4 mb-3">
                                    <img src="{{ Str::startsWith($imagePath, 'http') ? $imagePath : asset('storage/' . $imagePath) }}" class="img-fluid rounded" alt="{{ $page->name }}">
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @break
                @case('slider')
                    @if(!empty($page->sliders))
                        <div class="mb-4">
                            <div class="owl-carousel owl-theme">
                                @foreach($page->sliders as $slider)
                                    <div class="item">
                                        <div class="row align-items-center">
                                            @if(!empty($slider['image_path']) && (!empty($slider['title']) || !empty($slider['description'])))
                                                {{-- Both exist: 50/50 split --}}
                                                <div class="col-md-6">
                                                    @if(!empty($slider['title']))
                                                        <h4>{{ $slider['title'] }}</h4>
                                                    @endif
                                                    @if(!empty($slider['description']))
                                                        <p>{!! $slider['description'] !!}</p>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    <img src="{{ asset('storage/' . $slider['image_path']) }}" class="img-fluid" alt="Slider Image">
                                                </div>
                                            @elseif(!empty($slider['image_path']))
                                                {{-- Only image exists: full width --}}
                                                <div class="col-12">
                                                    <img src="{{ asset('storage/' . $slider['image_path']) }}" class="img-fluid" alt="Slider Image">
                                                </div>
                                            @else
                                                {{-- Only text exists: full width --}}
                                                <div class="col-12">
                                                    @if(!empty($slider['title']))
                                                        <h4>{{ $slider['title'] }}</h4>
                                                    @endif
                                                    @if(!empty($slider['description']))
                                                        <p>{!! $slider['description'] !!}</p>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
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
                    @if(!empty($page->{'extr-image_paths'}))
                        <div class="row mb-4">
                            @if(!empty($page->{'extr-image_paths'}))
                                @foreach ($page->{'extr-image_paths'} as $extrImagePath)
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

@push('scripts')
<script>
$(document).ready(function(){
  $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
  })
});
</script>
@endpush
