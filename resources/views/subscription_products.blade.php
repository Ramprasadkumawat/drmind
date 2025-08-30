@extends('index')
@section('content')
 <div class="section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 pb-5 d-flex flex-column">
            <h6 class="text-center text-dark 100">Exclusive Subscription Based Products</h6>
            <h2 class="text-center">Our Featured Products</h2>
          </div>
          @if($products->isEmpty())
            <div class="col-12 text-center">
              <p class="text-muted">No products available at the moment.</p>
            </div>
          @endif
          @foreach($products as $product)
          <div class="col-sm-6	col-md-4	col-lg-4	col-xl-4 mt-4	col-xxl-4 d-flex flex-column Product-card gap-3 pb-4">
            <a href="{{ route('products.subscriptionDetails',$product->slug) }}" class="text-decoration-none text-dark">
                        @if(isset($product->productImages[0]))
              <img src="{{ asset($product->productImages[0]->image_path) }}" width="100%" alt="{{ $product->productImages[0]->image_name }}">
            @else
              <img src="{{ asset('images/default.jpg') }}" width="100%" alt="No image">
            @endif

            <h5 class="text-dark">{{ $product->product_name }} <small>({{ $product->category->name }})</small></h5>
            <div>
              
              <h6 class="text-success">{{ $product->monthly_price."/month" }}</h6>
              <small class="text-dark opacity-50">@php echo $product->short_description @endphp </small>
              <form>
                <button class="btn btn-primary mt-2" type="button">Subscribe Now</button>
              </form>
            </div>
            </a>
             <div class="d-flex justify-content-center gap-2 mt-2">
            <!-- Facebook -->
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('products.subscriptionDetails',$product->slug)) }}" target="_blank" title="Share on Facebook">
              <i class="fab fa-facebook fa-lg text-primary"></i>
            </a>
            <!-- Instagram (no direct share, link to product page) -->
            <a href="https://www.instagram.com/?url={{ urlencode(route('products.subscriptionDetails',$product->slug)) }}" target="_blank" title="Share on Instagram">
              <i class="fab fa-instagram fa-lg text-danger"></i>
            </a>
            <!-- WeChat (no direct share, link to product page) -->
            <a href="{{ route('products.subscriptionDetails',$product->slug) }}" target="_blank" title="Share on WeChat">
              <i class="fab fa-weixin fa-lg text-success"></i>
            </a>
            <!-- YouTube (no direct share, link to product page) -->
            <a href="{{ route('products.subscriptionDetails',$product->slug) }}" target="_blank" title="Share on YouTube">
              <i class="fab fa-youtube fa-lg text-danger"></i>
            </a>
            <!-- WhatsApp -->
            <a href="https://wa.me/?text={{ urlencode(route('products.subscriptionDetails',$product->slug)) }}" target="_blank" title="Share on WhatsApp">
              <i class="fab fa-whatsapp fa-lg text-success"></i>
            </a>
          </div>
          </div>
         
          @endforeach
        </div>
      </div>
    </div>
    
@endsection