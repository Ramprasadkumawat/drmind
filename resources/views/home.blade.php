@extends('index')
@section('content')
<div class="section bannersection">
    <div class="container">
        <div class="row">
            <div class="col">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @if(isset($homepage) && $homepage->slider_text || $homepage->slider_image_path)
                        <div class="carousel-item active">
                            <div class="container">
                                <div class="row">
                                    <div class="col align-items-start justify-content-center d-flex flex-column">
                                        <h1>{{ $homepage->slider_text ?? 'Welcome to Our Homepage' }}</h1>
                                    </div>
                                    <div class="col align-items-center d-flex">
                                        <img class="bannerimgg"
                                            src="{{ isset($homepage->slider_image_path) && Str::startsWith($homepage->slider_image_path, 'http') ? $homepage->slider_image_path : asset('storage/' . $homepage->slider_image_path) }}"
                                            alt="Slider Image">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        {{-- Default static carousel item if no dynamic homepage or content --}}
                        <div class="carousel-item active">
                            <div class="container">
                                <div class="row">
                                    <div class="col  align-items-start justify-content-center d-flex flex-column">
                                        <h1>Real Life Education</h1>
                                    </div>
                                    <div class="col align-items-center d-flex">
                                        <img class="bannerimgg"
                                            src="{{ asset('assets/front/img/Screenshot 2025-05-05 125209.png') }}"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    @if(isset($homepage) && $homepage->slider_text || $homepage->slider_image_path)
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Main Paragraph Content --}}
@if(isset($homepage) && $homepage->main_paragraph_content)
<div class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 pb-5 d-flex flex-column">
                <h2 class="text-center">{{ $homepage->name }}</h2>
                <p>{!! $homepage->main_paragraph_content !!}</p>
            </div>
        </div>
    </div>
</div>
@endif

{{-- Extra Images Section --}}
@if(isset($homepage) && $homepage->{'extr-image_paths'})
    @php
        $extraImages = json_decode($homepage->{'extr-image_paths'}, true);
    @endphp
    @if(!empty($extraImages))
    <div class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 pb-5 d-flex flex-column">
                    <h2 class="text-center">More from {{ $homepage->name }}</h2>
                </div>
                @foreach($extraImages as $image)
                    <div class="col-md-4 mb-4">
                        <img src="{{ Str::startsWith($image, 'http') ? $image : asset('storage/' . $image) }}" class="img-fluid" alt="Extra Image">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
@endif

<div class="section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 pb-5 d-flex flex-column">
          <h6 class="text-center text-dark 100">Welcome to Dr. Mind</h6>
          <h2 class="text-center">Popular Category</h2>
        </div>'
        @if(!empty($category))
        @foreach ($category as $row)
       <div class="col-sm-6	col-md-4	col-lg-3	col-xl-2	col-xxl-2 d-flex flex-column carrdd gap-3 pb-4">
          <a href="{{route('products.by.category',$row->slug)}}"> 
            <img src="{{ Str::startsWith($row->image_path, 'http') ? $row->image_path : asset($row->image_path) }}" class="card-imgg" width="100%" alt="">
            <h6 class="text-center text-dark">{{ $row->name }}</h6>
          </a>
          </div>
        
         @endforeach
        @endif
      </div>
    </div>
  </div>
  @if(!empty($data))
  @foreach($data as $row)
  <div class="section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 pb-5 d-flex flex-column">
          <h6 class="text-center text-dark 100">Exclusive Products</h6>
          <h2 class="text-center">{{ $row['product_type']; }}</h2>
        </div>
        @if($row['products'])
          @foreach($row['products'] as $products)
              <div class="col-sm-6	col-md-4	col-lg-4	col-xl-4	col-xxl-4 d-flex flex-column Product-card gap-3 pb-4">
                <a href="{{route('products.productDetails',$products->slug)}}"><img src="{{ Str::startsWith($products->productImages[0]->image_path, 'http') ? $products->productImages[0]->image_path : asset($products->productImages[0]->image_path ?? env('IMAGE_NOT_FOUND')) }}" width="100%" alt="">
                <h5 class="text-dark">{{ $products->product_name }}</h5>
                <div>
                      @php 
                        $lastPrice = '';
                      if($products->product_discount_type != 'none'){
                            $lastPrice = '<span class="strikeouttest">${{ $row->products->product_price }}</span>';
                      }
                    @endphp
                  <h6 class="text-success">${{ $products->base_price }}</h6>
                  <small class="text-dark opacity-50">Points you Earn On Buying this product: <span
                      class="text-warning">{{ $products->earning_point ?? 0 }}</span></small>
                </div>
              </a>
              </div>
          @endforeach
        @endif
      
        <button class="button-buton seemore">Show More</button>
      </div>
    </div>
  </div>
  @endforeach
  @endif
  <div class="section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 pb-5 d-flex flex-column">
          <h6 class="text-center text-dark 100">Our Testimonials</h6>
          <h2 class="text-center">What Patient Say</h2>
        </div>
        <div class="container">
          <div id="owl-demo1" class="owl-carousel">

            <div class="allitem">
              <div class="blog-allof">
                <div class="img-date">
                  <img src="{{ asset('assets/front/img/imgg (8).png') }}">
                </div>
                <div class="discretion-blog">
                  <p>Reduce operational costs with no compromise on how you run your business.</p>
                  <h3>Shruti Singh</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
   <script>
      $(".seemore").click(function() {
        window.location.href = "products";
      });
   </script>
    @endsection