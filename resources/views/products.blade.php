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
            </a>
          </div>
          @endforeach
        </div>
      </div>
    </div>
    
@endsection