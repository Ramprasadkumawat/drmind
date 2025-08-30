@extends('admin.layout.template')
@section('content')
  <div class="card mb-3">
      <div class="card-body">
              @if (session('success'))
                  <div class="alert alert-success">
                      {{ session('success') }}
                  </div>
              @endif
        {{-- <div class="row flex-between-center">
          <div class="col-sm-auto mb-2 mb-sm-0">
            <h6 class="mb-0">Showing 1-24 of 205 Products</h6>
          </div>
          <div class="col-sm-auto">
            <div class="row gx-2 align-items-center">
              <div class="col-auto">
                <form class="row gx-2">
                  <div class="col-auto"><small>Sort by:</small></div>
                  <div class="col-auto"> <select class="form-select form-select-sm" aria-label="Bulk actions">
                      <option selected="">Best Match</option>
                      <option value="Refund">Newest</option>
                      <option value="Delete">Price</option>
                    </select></div>
                </form>
              </div>
              <div class="col-auto pe-0"> <a class="text-600 px-1" href="../../../app/e-commerce/product/product-list.html" data-bs-toggle="tooltip" data-bs-placement="top" title="Product List"><span class="fas fa-list-ul"></span></a></div>
            </div>
          </div>
        </div> --}}
      </div>
  </div>
  <div class="card">
    <div class="card-body">
     <div class="row">
  @if($products->count() > 0)
    @foreach($products as $product)
      <div class="mb-4 col-md-6 col-lg-4">
        <div class="border rounded-1 h-100 d-flex flex-column justify-content-between pb-3">
          <div class="overflow-hidden">
            <div class="position-relative rounded-top overflow-hidden">
              @if(!empty($product->productImages) && $product->productImages->count())
                <div class="swiper theme-slider" data-swiper='{"autoplay":true,"autoHeight":true,"spaceBetween":5,"loop":true,"loopedSlides":5,"navigation":{"nextEl":".swiper-button-next","prevEl":".swiper-button-prev"}}'>
                  <div class="swiper-wrapper">
                    @foreach($product->productImages as $image)
                      <div class="swiper-slide">
                        <a class="d-block" href="../../../app/e-commerce/product/product-details.html">
                          <img class="rounded-top img-fluid" src="{{ asset($image->image_path) }}" alt="" />
                        </a>
                      </div>
                    @endforeach
                  </div>
                  <div class="swiper-nav">
                    <div class="swiper-button-next swiper-button-white"></div>
                    <div class="swiper-button-prev swiper-button-white"></div>
                  </div>
                </div>
              @else
                <a class="d-block" href="../../../app/e-commerce/product/product-details.html">
                  <img class="img-fluid rounded-top" src="{{ asset('/product_images/' . $product->images) }}" alt="" />
                </a>
              @endif
              <span class="badge rounded-pill bg-success position-absolute mt-2 me-2 z-2 top-0 end-0">New</span>
            </div>

            <div class="p-3">
              <h5 class="fs-9">
                <a class="text-1100" href="../../../app/e-commerce/product/product-details.html">{{ $product->name }}</a>
              </h5>
              <p class="fs-10 mb-3">
                <a class="text-500" href="#!">
                  {{ $product->category->name }} {{ isset($product->subcategory) ? " / " . $product->subcategory->name : '' }}
                </a>
              </p>
              <h5 class="fs-md-7 text-warning mb-0 d-flex align-items-center mb-3">
                ${{ $product->product_price }}
              </h5>
              <p class="fs-10 mb-1">Stock:
                <strong class="{{ $product->product_stock > 0 ? 'text-success' : 'text-danger' }}">
                  {{ $product->product_stock > 0 ? 'Available' : 'Out of Stock' }}
                </strong>
              </p>
              <p>
                <a href="{{ route('add-product.edit', $product->id)  }}" class="badge bg-info">Edit</a>
                <a href="" class="badge bg-danger">Delete</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  @endif
</div>

    </div>
    {{-- <div class="card-footer bg-body-tertiary d-flex justify-content-center">
      <div><button class="btn btn-falcon-default btn-sm me-2" type="button" disabled="disabled" data-bs-toggle="tooltip" data-bs-placement="top" title="Prev"><span class="fas fa-chevron-left"></span></button><a class="btn btn-sm btn-falcon-default text-primary me-2" href="#!">1</a><a class="btn btn-sm btn-falcon-default me-2" href="#!">2</a><a class="btn btn-sm btn-falcon-default me-2" href="#!"> <span class="fas fa-ellipsis-h"></span></a><a class="btn btn-sm btn-falcon-default me-2" href="#!">35</a><button class="btn btn-falcon-default btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Next"><span class="fas fa-chevron-right">     </span></button></div>
    </div> --}}
  </div>
@endsection
