@extends('admin.layout.template')
@section('content')
      <div class="card mb-3">
          <div class="card-body">
              <div class="row flex-between-center">
                  <div class="col-md">
                      <h5 class="mb-2 mb-md-0">Add a Category</h5>
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
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">

                      @csrf
                      <div class="row gx-2">
                        @if(isset($category))
                          <input type="hidden" name="id" value="{{ $category->id }}">
                        @endif
                        <!-- Category Type Field -->
                        <div class="col-12 mb-3">
                          <label class="form-label" for="product-name">Category Type:</label>
                          <select class="form-control @error('type') is-invalid @enderror" name="type" id="product-name">
                            <option value="physical" {{ old('type', isset($category) ? $category->type : '') == 'physical' ? 'selected' : '' }}>Physical Product</option>
                            <option value="e-product" {{ old('type', isset($category) ? $category->type : '') == 'e-product' ? 'selected' : '' }}>E-Product</option>
                            <option value="services" {{ old('type', isset($category) ? $category->type : '') == 'services' ? 'selected' : '' }}>Services</option>
                          </select>
                          @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>

                        <!-- Category Name Field -->
                        <div class="col-12 mb-3">
                          <label class="form-label" for="manufacturar-name">Category Name:</label>
                            <input class="form-control @error('category_name') is-invalid @enderror"
                               id="manufacturar-name"
                               name="category_name"
                               type="text"
                               value="{{ old('category_name', isset($category) ? $category->name : '') }}" />
                          @error('category_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>

                        <div class="col-12 mb-3">
                          <label class="form-label" for="image">Image:</label>
                          <input class="form-control @error('image') is-invalid @enderror"
                             id="image"
                             name="image"
                             type="file"
                          />
                          @if(isset($category) && $category->image_path)
                          <div class="mt-2">
                            <img src="{{ asset($category->image_path) }}" alt="Category Image" style="max-width: 120px; max-height: 120px;">
                          </div>
                          @endif
                          @error('image')
                          <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>

                        <div class="col-12">
                          <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                      </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="card mb-3">
            <div class="card-header">
              <div class="row flex-between-end">
                <div class="col-auto align-self-center">


                </div>
                <div class="col-auto ms-auto">

                </div>
              </div>
            </div>
            <div class="card-body pt-0">
              <div class="tab-content">
                <div class="tab-pane preview-tab-pane active" role="tabpanel" aria-labelledby="tab-dom-da4be276-f13c-47d6-be82-655bc6452fd5" id="dom-da4be276-f13c-47d6-be82-655bc6452fd5">
                  <div id="tableExample3" data-list='{"valueNames":["name","email","age"],"page":5,"pagination":true}'>
                    <div class="row justify-content-end g-0">
                      <div class="col-auto col-sm-5 mb-3">
                        <form>
                          <div class="input-group"><input class="form-control form-control-sm shadow-none search" type="search" placeholder="Search..." aria-label="search" />
                            <div class="input-group-text bg-transparent"><span class="fa fa-search fs-10 text-600"></span></div>
                          </div>
                        </form>
                      </div>
                    </div>
                    <div class="table-responsive scrollbar">
                      <table class="table table-bordered table-striped fs-10 mb-0">
                        <thead class="bg-200">
                          <tr>
                            <th class="text-900 sort" data-sort="name">Name</th>
                            <th class="text-900 sort" data-sort="name">Image</th>
                            <th class="text-900 sort" data-sort="email">Type</th>
                            <th class="text-900 sort" data-sort="status">Status</th>
                            <th class="text-900 sort" data-sort="age">Action</th>
                          </tr>
                        </thead>
                        <tbody class="list">
                            @if($categories)
                                @foreach ($categories as $item)

                          <tr>
                            <td class="name">{{ $item->name }}</td>
                            <td class="name"><img src="{{ asset($item->image_path); }}" width="100px" height="100px"></td>
                            <td class="email">{{ $item->type }}</td>
                            <td class="status">{{ $item->status==1 ? 'Active' : 'Disable' }}</td>
                            <td class="action">
                                <a href="{{ route('categories.edit', $item->id) }}" class="badge bg-info">Edit</a>
                                <form action="{{ route('categories.destroy', $item->id) }}" method="POST" style="display:inline;">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="badge bg-danger border-0" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                </form>
                            </td>
                          </tr>

                          @endforeach

                          @endif

                        </tbody>
                      </table>
                    </div>
                    <div class="d-flex justify-content-center mt-3"><button class="btn btn-sm btn-falcon-default me-1" type="button" title="Previous" data-list-pagination="prev"><span class="fas fa-chevron-left"></span></button>
                      <ul class="pagination mb-0"></ul><button class="btn btn-sm btn-falcon-default ms-1" type="button" title="Next" data-list-pagination="next"><span class="fas fa-chevron-right"> </span></button>
                    </div>
                  </div>
                </div>

              </div>
            </div>
        </div>
      </div>
    @endsection
