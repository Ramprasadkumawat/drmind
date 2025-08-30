@extends('admin.layout.template')
@section('content')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>


    <link href="vendors/choices/choices.min.css" rel="stylesheet">
    <link href="vendors/flatpickr/flatpickr.min.css" rel="stylesheet">
    <link href="vendors/dropzone/dropzone.css" rel="stylesheet">

      <form class="dropzone dropzone-multiple p-0" 
          id="dropzoneMultipleFileUpload"
          method="POST"
          action="{{ route('add-product.update', $product->id) }}"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card mb-3">
            <div class="card-body">
                <div class="row flex-between-center">
                    <div class="col-md">
                        <h5 class="mb-2 mb-md-0">Update a product</h5>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                </div>
            </div>
        </div>
        <div class="row g-0">
            <div class="col-lg-8 pe-lg-2">
                <div class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Basic information</h6>
                    </div>
                    <div class="card-body">

                        <div class="row gx-2">
                            <div class="col-12 mb-3">
                                <label class="form-label" for="product-name">Product name:</label>
                                <span class="text-danger">
                                    @error('product_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <input class="form-control" id="product_name" name="product_name" type="text"
                                    value="{{ old('product_name', $product->product_name ?? '') }}" />
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label" for="manufacturar-name">Manufacturar Name:</label>
                                <span class="text-danger">
                                    @error('manufacturar_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <input class="form-control" id="manufacturar_name" name="manufacturar_name" type="text"
                                    value="{{ old('manufacturar_name', $product->manufacturar_name ?? '') }}" />
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label" for="identification-no">Product Identification No.:</label>
                                <span class="text-danger">
                                    @error('product_identification_no')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <input class="form-control" name="product_identification_no" id="product_identification_no"
                                    type="text"
                                    value="{{ old('product_identification_no', $product->product_identification_no ?? '') }}" />
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label" for="product-summary">Product SKU: </label>
                                <span class="text-danger">
                                    @error('product_sku')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <input class="form-control" name="product_sku" id="product_sku" type="text"
                                    value="{{ old('product_sku', $product->product_sku ?? '') }}" />
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Add images <span class="badge bg-info" style="float:right">Update Image</h6>
                        </span>
                    </div>
                    <div class="card-body">
                      <div class="row mb-3">
                        @if(!empty($product->productImages) && count($product->productImages))
                          @foreach($product->productImages as $image)
                            <div class="col-auto mb-2" style="position:relative;">
                              <div style="width:100px;height:100px;overflow:hidden;border:1px solid #ddd;border-radius:6px;display:flex;align-items:center;justify-content:center;position:relative;background:#f8f9fa;">
                                <img src="{{ asset($image->image_path) }}" alt="Product Image" style="max-width:100%;max-height:100%;">
                                <!-- Remove Icon -->
                                <!-- Delete Icon (AJAX) -->
                                <button type="button"
                                  class="btn-delete-image"
                                  data-image-id="{{ $image->id }}"
                                  style="background:transparent;border:none;padding:0;cursor:pointer;position:absolute;top:4px;right:28px;"
                                  title="Remove Image">
                                  <span style="color:#dc3545;font-size:18px;">
                                    <i class="fas fa-trash-alt"></i>
                                  </span>
                                </button>
                                <!-- Update Icon (AJAX) -->
                                <label style="cursor:pointer;margin:0;position:absolute;top:4px;right:4px;">
                                  <span style="color:#0d6efd;font-size:18px;">
                                    <i class="fas fa-edit"></i>
                                  </span>
                                  <input type="file"
                                    class="input-update-image"
                                    data-image-id="{{ $image->id }}"
                                    accept="image/*"
                                    style="display:none;">
                                </label>
                               
                              </div>
                            </div>
                          @endforeach
                        @endif
                      </div>
                      <div class="fallback">
                        <input name="images[]" type="file" multiple="multiple" />
                        <span class="text-danger">
                          @error('file')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="row gx-2">
                            <div class="col-12 mb-3">
                                <label class="form-label" for="product-description">Product description:</label>
                                <div class="create-product-description-textarea">
                                    <textarea class="" data-tinymce="data-tinymce" name="description" id="editor">{{ old('description', $product->description ?? '') }}</textarea>
                                    <span class="text-danger">
                                        @error('description')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label" for="product-description">Product Short description:</label>
                                <div class="create-product-description-textarea">
                                    <textarea class="" data-tinymce="data-tinymce" name="short_description" id="editor1">{{ old('short_description', $product->short_description ?? '') }}</textarea>
                                    <span class="text-danger">
                                        @error('short_description')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label class="form-label" for="import-status">Product Status: </label>
                                <select class="form-select" id="product_status" name="product_status">
                                    <option value="publish"
                                        {{ old('product_status', $product->product_status ?? '') == 'publish' ? 'selected' : '' }}>
                                        Publish</option>
                                    <option value="inactive"
                                        {{ old('product_status', $product->product_status ?? '') == 'inactive' ? 'selected' : '' }}>
                                        In-active</option>
                                    <option value="upcomming"
                                        {{ old('product_status', $product->product_status ?? '') == 'upcomming' ? 'selected' : '' }}>
                                        Up-Comming</option>
                                    <option value="draft"
                                        {{ old('product_status', $product->product_status ?? '') == 'draft' ? 'selected' : '' }}>
                                        Draft</option>
                                </select>
                                <span class="text-danger">
                                    @error('product_status')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label class="form-label" for="release-date">Release Date: </label>
                                <input class="form-control datetimepicker" name="publish_date" id="release-date"
                                    type="text" data-options='{"dateFormat":"Y-m-d","disableMobile":true}'
                                    value="{{ old('publish_date', $product->publish_date ?? '') }}" />
                                <span class="text-danger">
                                    @error('publish_date')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label" for="warranty-length">Stock Quantity: </label>
                                <input class="form-control" name="product_stock" id="warranty-length" type="text"
                                    value="{{ old('product_stock', $product->product_stock ?? '') }}" />
                                <span class="text-danger">
                                    @error('product_stock')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="card-header bg-body-tertiary">
                            <h6 class="mb-0">Level point and Earning Point</h6>
                        </div>
                        <div class="row gx-2">
                            <div class="col-sm-4 mb-3">
                                <label class="form-label" for="level_one">Level 1:</label>
                                <input class="form-control" name="level_one" id="level_one" type="text"
                                    value="{{ old('level_one', $product->level_one ?? '') }}" />
                                <span class="text-danger">
                                    @error('level_one')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-sm-4 mb-3">
                                <label class="form-label" for="level_two">Level 2:</label>
                                <input class="form-control" name="level_two" id="level_two" type="text"
                                    value="{{ old('level_two', $product->level_two ?? '') }}" />
                                <span class="text-danger">
                                    @error('level_two')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-sm-4 mb-3">
                                <label class="form-label" for="level_three">Level 3:</label>
                                <input class="form-control" name="level_three" id="level_three" type="text"
                                    value="{{ old('level_three', $product->level_three ?? '') }}" />
                                <span class="text-danger">
                                    @error('level_three')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label" for="product-summary">Earning Point: </label>
                                <input class="form-control" name="earning_point" id="earning_point" type="text"
                                    value="{{ old('earning_point', $product->earning_point ?? '') }}" />
                                <span class="text-danger">
                                    @error('earning_point')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3 mb-lg-0">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Specifications</h6>
                    </div>
                    <div class="card-body" id="specificationList">
                        <!-- Dynamic specifications will be added here -->
                        @if (!empty(old('specification_terms', $product->specification_terms ?? [])))
                            @php
                                
                                $specData = json_decode($product->specification_terms);
                            @endphp
                           @foreach ($specData as $label => $property)
    <div class="row gx-2 flex-between-center mb-3 specification-item">
        <div class="col-sm-3">
            <h6 class="mb-0 text-600">{{ $label }}</h6>
            <input type="hidden" name="specification_terms[]" value="{{ $label }}">
        </div>
        <div class="col-sm-9">
            <div class="d-flex flex-between-center">
                <h6 class="mb-0 text-700">{{ $property }}</h6>
                <input type="hidden" name="specification_property[]" value="{{ $property }}">
                <a class="btn btn-sm btn-link text-danger remove-spec" href="#!" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove">
                    <span class="fs-10 fas fa-trash-alt"></span>
                </a>
            </div>
        </div>
    </div>
@endforeach
                        @endif
                            <div class="row gy-3 gx-2">
                                <div class="col-sm-3">
                                    <input class="form-control form-control-sm" id="specification-label"
                                        name="specification_terms[]" type="text" placeholder="Label" />
                                </div>
                                <div class="col-sm-9">
                                    <div class="d-flex gap-2 flex-between-center">
                                        <input class="form-control form-control-sm" id="specification-property"
                                            type="text" placeholder="Property" name="specification_property[]" />
                                        <button class="btn btn-sm btn-falcon-default" id="addSpecification">Add</button>
                                    </div>
                                </div>
                            </div>
                      
                    </div>
                </div>

            </div>
            <div class="col-lg-4 ps-lg-2">
                <div class="sticky-sidebar">
                    <div class="card mb-3">
                        <div class="card-header bg-body-tertiary">
                            <h6 class="mb-0">Type</h6>
                        </div>
                        <div class="card-body">
                            <div class="row gx-2">
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="product-category">Select category:</label>
                                    <select class="form-select" id="product_category" name="product_category">
                                        <option value="">Select category</option>
                                        @if ($categories)
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('product_category', $product->product_category ?? '') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span class="text-danger">
                                        @error('product_category')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="product-subcategory">Select sub-category:</label>
                                    <select class="form-select" id="product_subcategory" name="product_subcategory">
                                        <option value="">Select sub-category</option>
                                        {{-- Subcategories will be loaded via AJAX --}}
                                    </select>
                                    <span class="text-danger">
                                        @error('product_subcategory')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-header bg-body-tertiary">
                            <h6 class="mb-0">Tags</h6>
                        </div>
                        <div class="card-body">
                            <label class="form-label" for="product-tags">Add a keyword:</label>
                            <input class="form-control js-choice" id="product-tags" type="text" name="tags"
                                size="1" data-options='{"removeItemButton":true,"placeholder":false}'
                                value="{{ old('tags', $product->tags ?? '') }}" />
                            <span class="text-danger">
                                @error('tags')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-header bg-body-tertiary">
                            <h6 class="mb-0">Pricing</h6>
                        </div>
                        <div class="card-body">
                            <div class="row gx-2">
                                <div class="col-8 mb-3">
                                    <label class="form-label" for="base-price">Base Price: <span data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Product regular price"><span
                                                class="fas fa-question-circle text-primary fs-10 ms-1"></span></span></label>
                                    <input class="form-control" id="base_price" name="base_price" type="text"
                                        value="{{ old('base_price', $product->base_price ?? '') }}" />
                                    <span class="text-danger">
                                        @error('base_price')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-4">
                                    <label class="form-label" for="price-currency">Currency:</label>
                                    <select class="form-select" id="price_currency" name="price_currency">
                                        <option value="usd"
                                            {{ old('price_currency', $product->price_currency ?? '') == 'usd' ? 'selected' : '' }}>
                                            USD</option>
                                    </select>
                                    <span class="text-danger">
                                        @error('price_currency')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-12 mb-4">
                                    <label class="form-label" for="discount-percentage-type">Product Discount:</label>
                                    <select class="form-select" id="product_discount" name="product_discount_type">
                                        <option value="none"
                                            {{ old('product_discount_type', $product->product_discount_type ?? '') == 'none' ? 'selected' : '' }}>
                                            None</option>
                                        <option value="fixed"
                                            {{ old('product_discount_type', $product->product_discount_type ?? '') == 'fixed' ? 'selected' : '' }}>
                                            Fixed</option>
                                        <option value="percentage"
                                            {{ old('product_discount_type', $product->product_discount_type ?? '') == 'percentage' ? 'selected' : '' }}>
                                            Percentage</option>
                                    </select>
                                    <span class="text-danger">
                                        @error('product_discount_type')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-12 mb-4"
                                    style="{{ old('product_discount_type', $product->product_discount_type ?? '') != 'none' && old('product_discount_type', $product->product_discount_type ?? '') != '' ? '' : 'display: none;' }}"
                                    id="showProductPricediv">
                                    <label class="form-label" for="discount-value">Discount value:</label>
                                    <input class="form-control" id="discount_value" type="text" name="discount_value"
                                        value="{{ old('discount_value', $product->discount_value ?? '') }}" />
                                    <span class="text-danger">
                                        @error('discount_value')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="final-price">Final price:<span
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Product final price"><span
                                                class="fas fa-question-circle text-primary fs-10 ms-1"></span></span></label>
                                    <input class="form-control" id="product_price" name="product_price" type="text"
                                        value="{{ old('product_price', $product->product_price ?? '') }}" />
                                    <span class="text-danger">
                                        @error('product_price')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-header bg-body-tertiary">
                            <h6 class="mb-0">Shipping</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-check">
                                <input value="vendor" class="form-check-input p-2" id="vendor-delivery" type="radio"
                                    name="product_shipping"
                                    {{ old('product_shipping', $product->product_shipping ?? 'vendor') == 'vendor' ? 'checked' : '' }} />
                                <label class="form-check-label fs-9 fw-normal text-700" for="vendor-delivery">Delivered by
                                    vendor</label>
                            </div>
                            <div class="form-check">
                                <input value="drmind" class="form-check-input p-2" id="falcon-delivery" type="radio"
                                    name="product_shipping"
                                    {{ old('product_shipping', $product->product_shipping ?? '') == 'drmind' ? 'checked' : '' }} />
                                <label class="form-check-label fs-9 fw-normal text-700" for="falcon-delivery">Delivered by
                                    DrMind <span
                                        class="badge badge-subtle-warning rounded-pill ms-2">Recommended</span></label>
                            </div>
                            <span class="text-danger">
                                @error('product_shipping')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-header bg-body-tertiary">
                            <h6 class="mb-0">Stock status</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-check">
                                <input class="form-check-input p-2" id="in-stock" type="radio" name="stock_status"
                                    value="instock"
                                    {{ old('stock_status', $product->stock_status ?? 'instock') == 'instock' ? 'checked' : '' }} />
                                <label class="form-check-label fs-9 fw-normal text-700" for="in-stock">In stock</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input p-2" id="unavailable" type="radio" name="stock_status"
                                    value="out_of_stock"
                                    {{ old('stock_status', $product->stock_status ?? '') == 'out_of_stock' ? 'checked' : '' }} />
                                <label class="form-check-label fs-9 fw-normal text-700" for="unavailable">Out Of
                                    Stock</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input p-2" id="to-be-announced" type="radio"
                                    name="stock_status" value="to_be_announced"
                                    {{ old('stock_status', $product->stock_status ?? '') == 'to_be_announced' ? 'checked' : '' }} />
                                <label class="form-check-label fs-9 fw-normal text-700" for="to-be-announced">To be
                                    announced</label>
                            </div>
                            <span class="text-danger">
                                @error('stock_status')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="card mt-3">
            <div class="card-body">
                <div class="row justify-content-between align-items-center">
                    <div class="col-md">
                        <h5 class="mb-2 mb-md-0">You're almost done!</h5>
                    </div>
                    <div class="col-auto"><button class="btn btn-link text-secondary p-0 me-3 fw-medium"
                            role="button">Discard</button><button type="submit" class="btn btn-primary">Update product
                        </button></div>
                </div>
            </div>
        </div>
    </form>


    <script src="vendors/tinymce/tinymce.min.js"></script>
    <script src="vendors/choices/choices.min.js"></script>
    <script src="vendors/flatpickr/flatpickr.min.js"></script>
    <script src="vendors/dropzone/dropzone-min.js"></script>

    <script>
      // Use base URLs without ID, append ID dynamically in JS
      const imageDeleteUrl = '{{ url("productImageDelete") }}'; // e.g. .../delete/{id}
      const imageUpdateUrl = '{{ url("productImageUpdate") }}/'; // e.g. .../update/{id}
    </script>
    <script src="{{ asset('assets/js/addproduct.js') }}"></script>

     <script>
                              
                                  // Delete image AJAX
                                    $('.btn-delete-image').on('click', function() {
                                      if(!confirm('Are you sure you want to delete this image?')) return;
                                      let imageId = $(this).data('image-id');
                                      let parentDiv = $(this).closest('.col-auto');
                                      $.ajax({
                                          url: imageDeleteUrl,
                                          method: 'POST',
                                          data: { id: imageId, _token: '{{ csrf_token() }}' },
                                          dataType: 'json',
                                          success: function(data) {
                                          if(data.success) {
                                            parentDiv.remove();
                                            alert(data.message);
                                          } else {
                                            alert(data.message || 'Failed to delete image.');
                                          }
                                          },
                                          error: function() {
                                            alert('Failed to delete image.');
                                          }
                                      });
                                    });
                                  

                                 
                                 $('.input-update-image').on('change', function () {
                                  let imageId = $(this).data('image-id');
                                  let file = this.files[0];
                                  if (!file) return;

                                  let formData = new FormData();
                                  formData.append('image', file);
                                  formData.append('id', imageId); // ✅ Include image ID
                                  formData.append('_token', '{{ csrf_token() }}'); // ✅ CSRF token

                                  let inputElement = this; // ✅ Reference to use inside success callback

                                  $.ajax({
                                      url: imageUpdateUrl, // ✅ Ensure this is defined and points to the correct route
                                      method: 'POST',
                                      data: formData,
                                      processData: false,
                                      contentType: false,
                                      dataType: 'json',
                                      beforeSuccess:function(){
                                        let imgDiv = $(inputElement).closest('div');
                                        if (imgDiv.find('.image-upload-loader').length === 0) {
                                          imgDiv.append('<div class="image-upload-loader" style="position:absolute;top:0;left:0;width:100%;height:100%;background:rgba(255,255,255,0.7);display:flex;align-items:center;justify-content:center;z-index:10;"><span class="spinner-border spinner-border-sm text-primary" role="status" aria-hidden="true"></span> <span style="margin-left:8px;">Uploading...</span></div>');
                                        }
                                      },
                                      success: function (data) {
                                          if (data.success && data.image_path) {
                                              // ✅ Get the related image tag and update src
                                              let img = $(inputElement).closest('div').find('img')[0];
                                              if (img) {
                                                  img.src = data.image_path + '?t=' + Date.now(); // Add timestamp to prevent caching
                                              }
                                              alert(data.message);
                                          } else {
                                              alert(data.message || 'Failed to update image.');
                                          }
                                      },
                                      error: function () {
                                          alert('Failed to update image.');
                                      }
                                  });
                              });

                              
                                </script>
@endsection
