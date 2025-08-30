@extends('index')
@section('content')

    <div class="section">
        <div class="container mt-5">
            <div class="row">
                <!-- Product Images -->
                <div class="col-md-6 mb-4">
                   @if(isset($product->productImages[0]->image_path))
                    <img src="{{ asset($product->productImages[0]->image_path) }}" alt="{{ $product->productImages[0]->image_name }}"
                        class="img-fluid rounded mb-3 product-image" id="mainImage">
                   @endif
                   
                    <div class="d-flex justify-content-start gap-3">
                        @if(isset($product->productImages))
                            @foreach ($product->productImages as $images)
                                <img src="{{ asset($images->image_path ?? env('IMAGE_NOT_FOUND'))   }}" alt="{{ $images->image_name }}"
                                    class="thumbnail rounded" onclick="changeImage(event, this.src)">
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- Product Details -->
                <div class="col-md-6">
                    <h2 class="mb-3">{{ $product->product_name }}</h2>
                    <p class="text-muted mb-4">SKU: {{ $product->product_sku }}</p>
                    <div class="mb-3">
                        <span class="h4 me-2">${{ $product->monthly_price }}</span>
                        
                        {{-- <span class="text-muted" style="display:{{ $display }}"><s>{{ $product->base_price }}</s></span> --}}
                    </div>
                    <div class="mb-3">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-half text-warning"></i>
                        <span class="ms-2">4.5</span>
                    </div>
                    <p class="mb-4">{{ $product->category->name }} {{  isset($product->subcategory->name) ?? "/". $product->subcategory->name }}</p>
                    <p class="mb-4">@php echo $product->short_description @endphp </p>
                  
                    <form action="{{ route('subscribe') }}" method="POST">
                    @csrf
                   
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="product_price" value="{{ $product->monthly_price }}">
                    <button type="submit" class="btn btn-danger btn-lg mb-3 me-2">
                        <i class="bi bi-cart-plus"></i> Buy Subscription
                    </button>
                  
                    {{-- <button class="btn btn-outline-secondary btn-lg mb-3">
                        <i class="bi bi-heart"></i> Add to Wishlist
                    </button> --}}
                    </form>
                    <div class="mt-4">
                        <h5>Key Features:</h5>
                        <ul>
                        @if(!is_null($product->level_one))
                            <li>Level 1 Point : {{ $product->level_one }}</li>
                        @endif
                        @if(!is_null($product->level_two))
                            <li>Level 2 Point : {{ $product->level_two }}</li>
                        @endif
                        @if(!is_null($product->level_three))
                            <li>Level 3 Point : {{ $product->level_three }}</li>
                        @endif
                        @if(!is_null($product->earning_point))
                            <li>Earning Point : {{ $product->earning_point }}</li>
                        @endif
                        @if(!empty($product->specification_terms))
                            @php
                                $termSpec = json_decode($product->specification_terms, true);
                            @endphp
                            @if(is_array($termSpec))
                                @foreach($termSpec as $key => $value)
                                    <li>{{ $key }} :- {{ $value }}</li>
                                @endforeach
                            @endif
                        @endif
                        </ul>
                       
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="my-4">
                        <h5>Key Features:</h5>                      
@php
echo $product->description;

@endphp
            </div>
              </div>
        </div>
    </div>
     <script>
        function changeImage(event, src) {
            document.getElementById('mainImage').src = src;
            document.querySelectorAll('.thumbnail').forEach(thumb => thumb.classList.remove('active'));
            event.target.classList.add('active');
        }
    </script>
@endsection