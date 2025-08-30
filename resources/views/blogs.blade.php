@extends('index')
@section('content')
<div class="section bannersection">
         @if(!empty($blogslist))
 
  <div class="section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 pb-5 d-flex flex-column">
          <h6 class="text-center text-dark 100">Explore a variety of exciting Blogs waiting for you.</h6>
          <h2 class="text-center">Blogs</h2>
        </div>
      
           @foreach($blogslist as $product)
          <div class="col-sm-6	col-md-4	col-lg-4	col-xl-4 mt-4	col-xxl-4 d-flex flex-column Product-card gap-3 pb-4">
            <a href="{{route('home.blog-details',$product->slug)}}" class="text-decoration-none text-dark">
                 
                        @php
                            $imagePath = public_path($product->image);
                        @endphp

           <img src="{{ asset($product->image) }}" width="100%" alt="" 
            onerror="this.onerror=null; this.src='{{ asset(env('IMAGE_NOT_FOUND')) }}';">
            <h5 class="text-dark">{{ $product->title }} </h5>
            <div>
            
              <small class="text-dark opacity-50">@php echo $product->message @endphp </small>
            </div>
            </a>
          </div>
          @endforeach
      
      </div>
    </div>
  </div>

  @endif
</div>
@endsection