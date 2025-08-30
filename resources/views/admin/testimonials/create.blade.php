@extends('admin.layout.template')
@section('content')
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script> --}}
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

    <form class="dropzone dropzone-multiple p-0" id="dropzoneMultipleFileUpload" action="{{ route('testimonial.store') }}"
        method="POST" enctype="multipart/form-data">
        @csrf
        
        {{-- Set updated_at value --}}
        @if(isset($testimonial->id))
        <input type="hidden" name="id" value="{{ $testimonial->id }}">
        @endif
        <div class="card mb-3">
            <div class="card-body">
                <div class="row flex-between-center">
                    <div class="col-md">
                        <h5 class="mb-2 mb-md-0">Add Testimonials</h5>
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
            <div class="col-lg-12 pe-lg-2">
                <div class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Basic information</h6>
                    </div>
                    <div class="card-body">

                        <div class="row gx-2">
                            <div class="col-12 mb-3">
                                <label class="form-label" for="product-name">Title:</label>
                                <span class="text-danger">
                                    @error('title')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <input class="form-control" id="title" name="title" type="text"
                                    value="{{ !empty($testimonial->title) ? $testimonial->title : old('title') }}" />
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label" for="product-name">Status:</label>
                                <span class="text-danger">
                                    @error('status')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <select class="form-control" name="status">
                                    <option value="draft" {{ !empty($testimonial->status) && ($testimonial->status=='draft') ? 'selected' : ''}}>Draft</option>
                                    <option value="publish" {{ !empty($testimonial->status) && ($testimonial->status=='publish') ? 'selected' : ''}}>Publish</option>
                                </select>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="card mb-3" id="allimage">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Add images</h6>
                    </div>
                    <div class="card-body">
                        <div class="fallback">
                            <input name="image" type="file" />
                            <span class="text-danger">
                                @error('image')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        @if(!empty($testimonial->image))
                        <img src="{{ asset($testimonial->image) }}" with="100px" height="80px"/>
                        @endif

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
                                    <textarea class="" data-tinymce="data-tinymce" name="description" id="editor" required>
                                        @if(!empty($testimonial->
                                        description))   
                                        {{ $testimonial->
                                        description }}
                                        @endif
                                    </textarea>
                                    <span class="text-danger">
                                        @error('description')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
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
                            Testimonials
                        </button></div>
                </div>
            </div>
        </div>
    </form>
    <script>
        CKEDITOR.replace('editor', {
            filebrowserUploadUrl: "/upload-testimonial-image?_token={{ csrf_token() }}",
            filebrowserUploadMethod: 'form'
        });
    </script>
@endsection
