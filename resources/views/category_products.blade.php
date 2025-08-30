@extends('index')
@section('content')
 <div class="section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 pb-5 d-flex flex-column">
            <h6 class="text-center text-dark 100">Exclusive Products</h6>
            <h2 class="text-center">Our Featured Products</h2>
          </div>
          @if($products->isEmpty())
            <div class="col-12 text-center">
              <p class="text-muted">No products available at the moment.</p>
            </div>
          @endif
          @foreach($products as $product)
          <div class="col-sm-6	col-md-4	col-lg-4	col-xl-4 mt-4	col-xxl-4 d-flex flex-column Product-card gap-3 pb-4">
            <a href="{{ route('products.productDetails',$product->slug) }}" class="text-decoration-none text-dark">
                        @if(isset($product->productImages[0]))
              <img src="{{ asset($product->productImages[0]->image_path) }}" width="100%" alt="{{ $product->productImages[0]->image_name }}">
            @else
              <img src="{{ asset('images/default.jpg') }}" width="100%" alt="No image">
            @endif

            <h5 class="text-dark">{{ $product->product_name }} <small>({{ $product->category->name }})</small></h5>
            <div>
              @php
              $class="text-success";
              $text="In Stock";
              if($product->product_stock <= 0){
                $class="text-danger";
                $text="Out of Stock";
              }
               if($product->product_stock <= 10){
                $class="text-warning";
                $text="Limited Stock" . " (" . $product->product_stock . ") left only";
              }
              @endphp
              <h6 class={{ $class }}>{{ $text }}</h6>
              <small class="text-dark opacity-50">@php echo $product->short_description @endphp </small>
            </div>
 <div class="d-flex gap-2 mt-2">
              <!-- Facebook Share -->
              <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('products.productDetails', $product->slug)) }}" target="_blank" title="Share on Facebook">
                <i class="fab fa-facebook fa-lg text-primary"></i>
              </a>
              <!-- Instagram (no direct share, link to Instagram homepage) -->
              <a href="https://www.instagram.com/" target="_blank" title="Share on Instagram">
                <i class="fab fa-instagram fa-lg text-danger"></i>
              </a>
              <!-- YouTube (no direct share, link to YouTube homepage) -->
              <a href="https://www.youtube.com/" target="_blank" title="Share on YouTube">
                <i class="fab fa-youtube fa-lg text-danger"></i>
              </a>
              <!-- WeChat (no direct share, link to WeChat homepage) -->
              <a href="https://www.wechat.com/" target="_blank" title="Share on WeChat">
                <i class="fab fa-weixin fa-lg text-success"></i>
              </a>
              <!-- WhatsApp Share -->
              <a href="https://api.whatsapp.com/send?text={{ urlencode(route('products.productDetails', $product->slug)) }}" target="_blank" title="Share on WhatsApp">
                <i class="fab fa-whatsapp fa-lg text-success"></i>
              </a>
            </div>
            </a>
          </div>
          @endforeach
        </div>
      </div>
    </div>
    
@endsection