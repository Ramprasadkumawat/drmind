@extends('admin.layout.template')
@section('content')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>


    <link href="vendors/choices/choices.min.css" rel="stylesheet">
    <link href="vendors/flatpickr/flatpickr.min.css" rel="stylesheet">
    <link href="vendors/dropzone/dropzone.css" rel="stylesheet">

    <form class="dropzone dropzone-multiple p-0" id="dropzoneMultipleFileUpload" action="{{ route('create-subscription-product.store') }}"
        method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card mb-3">
            <div class="card-body">
                <div class="row flex-between-center">
                    <div class="col-md">
                        <h5 class="mb-2 mb-md-0">Add a Subscription product</h5>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="text-danger">{{ $error }}</li>
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
                                    value="{{ old('product_name') }}" />
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label" for="identification-no">Product Identification No.:</label>
                                <span class="text-danger">
                                    @error('product_identification_no')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <input class="form-control" name="product_identification_no" id="product_identification_no"
                                    type="text" value="{{ old('product_identification_no') }}" />
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label" for="product-summary">Product SKU: </label>
                                <span class="text-danger">
                                    @error('product_sku')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <input class="form-control" name="product_sku" id="product_sku" type="text"
                                    value="{{ old('product_sku') }}" />
                            </div>


                        </div>

                    </div>
                </div>
                <div class="card mb-3" id="allimage">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Add images (multiple apply)</h6>
                    </div>
                    <div class="card-body">
                        <div class="fallback">
                            <input name="images[]" type="file" multiple="multiple" required />
                            <span class="text-danger">
                                @error('file')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>


                    </div>
                </div>

                <div class="card mb-3" id="e_book">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Add PDF For eBook Subscription Category</h6>
                    </div>
                    <div class="card-body">
                        <div class="fallback">
                            <input name="pdf_file" id="pdf_file" type="file" accept="application/pdf" />
                            <span class="text-danger">
                                <small id="pdf_error" style="display:none">Only PDF files are allowed.</small>
                                @error('pdf_file')
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
                            <div class="col-12 mb-3"><label class="form-label" for="product-description">Product
                                    description:</label>
                                <div class="create-product-description-textarea">
                                    <textarea class="" data-tinymce="data-tinymce" name="description" id="editor" required></textarea>
                                    <span class="text-danger">
                                        @error('description')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-12 mb-3"><label class="form-label" for="product-description">Product Short
                                    description:</label>
                                <div class="create-product-description-textarea">
                                    <textarea class="" data-tinymce="data-tinymce" name="short_description" id="editor1" required></textarea>
                                    <span class="text-danger">
                                        @error('short_description')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-3"><label class="form-label" for="import-status">Product Status:
                                </label>
                                <select class="form-select" id="product_status" name="product_status">
                                    <option value="publish">Publish</option>
                                    <option value="inactive">In-active</option>
                                    <option value="upcomming">Up-Comming</option>
                                    <option value="draft">Draft</option>
                                </select>
                                <span class="text-danger">
                                    @error('product_status')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-sm-6 mb-3"><label class="form-label" for="release-date">Release Date:
                                </label>
                                <input class="form-control datetimepicker" name="publish_date" id="release-date"
                                    type="text" data-options='{"dateFormat":"Y-m-d","disableMobile":true}' />
                                <span class="text-danger">
                                    @error('publish_date')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                        </div>
                        <div class="card-header bg-body-tertiary">
                            <h6 class="mb-0">Level point and Earning Point</h6>
                        </div>
                        <div class="row gx-2">
                            <div class="col-sm-4 mb-3"><label class="form-label" for="level_one">Level 1:</label>
                                <input class="form-control" name="level_one" id="level_one" type="text" />
                                <span class="text-danger">
                                    @error('level_one')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-sm-4 mb-3"><label class="form-label" for="level_two">Level 2:</label>
                                <input class="form-control" name="level_two" id="level_two" type="text" />
                                <span class="text-danger">
                                    @error('level_two')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-sm-4 mb-3"><label class="form-label" for="level_three">Level 3:</label>
                                <input class="form-control" name="level_three" id="level_three" type="text" />
                                <span class="text-danger">
                                    @error('level_three')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-12 mb-3"><label class="form-label" for="product-summary">Earning Point:
                                </label>
                                <input class="form-control" name="earning_point" id="earning_point" type="text" />
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
                        <div class="row gy-3 gx-2">
                            <div class="col-sm-3">
                                <input class="form-control form-control-sm" id="specification-label"
                                    name="specification_label[]" type="text" placeholder="Label" />
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
                                                    data-categorytype={{ $category->type }}>{{ $category->name }}</option>
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
                                size="1" data-options='{"removeItemButton":true,"placeholder":false}' />
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
                                    <label class="form-label" for="base-price">Monthly Price: <span
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Product Monthly Subscription price"><span
                                                class="fas fa-question-circle text-primary fs-10 ms-1"></span></span></label>
                                    <input class="form-control" id="monthly_price" name="monthly_price" type="text" />
                                    <span class="text-danger">
                                        @error('monthly_price')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                {{-- <div class="col-8 mb-3">
                                    <label class="form-label" for="base-price">Half Yearly Price: <span
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Product regular price"><span
                                                class="fas fa-question-circle text-primary fs-10 ms-1"></span></span></label>
                                    <input class="form-control" id="base_price" name="base_price" type="text" />
                                    <span class="text-danger">
                                        @error('base_price')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-8 mb-3">
                                    <label class="form-label" for="base-price">Yearly Price: <span
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Product regular price"><span
                                                class="fas fa-question-circle text-primary fs-10 ms-1"></span></span></label>
                                    <input class="form-control" id="base_price" name="base_price" type="text" />
                                    <span class="text-danger">
                                        @error('base_price')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div> --}}
                                <div class="col-4">
                                    <label class="form-label" for="price-currency">Currency:</label>
                                    <select class="form-select" id="price_currency" name="price_currency">
                                        <option value="usd">USD</option>
                                    </select>
                                    <span class="text-danger">
                                        @error('price_currency')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                {{-- <div class="col-12 mb-4">
                                    <label class="form-label" for="discount-percentage-type">Product Discount:</label>
                                    <select class="form-select" id="product_discount" name="product_discount_type">
                                        <option value="none">None</option>
                                        <option value="fixed">Fixed</option>
                                        <option value="percentage">Percentage</option>
                                    </select>
                                    <span class="text-danger">
                                        @error('product_discount_type')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-12 mb-4" style="display: none;" id="showProductPricediv">
                                    <label class="form-label" for="discount-value">Discount value:</label>
                                    <input class="form-control" id="discount_value" type="text"
                                        name="discount_value" />
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
                                    <input class="form-control" id="product_price" name="product_price"
                                        type="text" />
                                    <span class="text-danger">
                                        @error('product_price')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div> --}}
                            </div>
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
                            role="button">Discard</button><button type="submit" class="btn btn-primary">Add
                            Subscription
                        </button></div>
                </div>
            </div>
        </div>
    </form>


    <script src="vendors/tinymce/tinymce.min.js"></script>
    <script src="vendors/choices/choices.min.js"></script>
    <script src="vendors/flatpickr/flatpickr.min.js"></script>
    <script src="vendors/dropzone/dropzone-min.js"></script>

    <script src="{{ asset('assets/js/add-subscription-product.js') }}"></script>

    <script>
       

        $("#pdf_file").on('change', function() {
            var file = this.files[0];
            if (file) {
                var fileType = file.type;
                if (fileType !== "application/pdf") {
                    $("#pdf_error").show();
                    $(this).val(''); // Clear the invalid file
                } else {
                    $("#pdf_error").hide();
                }
            }
        });
    </script>
@endsection
