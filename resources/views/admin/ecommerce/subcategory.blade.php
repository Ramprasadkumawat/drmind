@extends('admin.layout.template')
@section('content')
    <div class="card mb-3">
        <div class="card-body">
            <div class="row flex-between-center">
                <div class="col-md">
                    <h5 class="mb-2 mb-md-0">Add a Sub-Category</h5>
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

                    <form action="{{ route('subcategory.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ isset($formData) ? $formData->id : '' }}">
                        <div class="row gx-2">
                            <!-- Category Type Field -->
                            <div class="col-12 mb-3">
                                <label class="form-label" for="product-name">Select Category:</label>
                                <select class="form-control @error('type') is-invalid @enderror" name="category_id" id="product-name">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ isset($formData) && ($formData->parent_id==$category->id) ? 'selected' : ''}}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Category Name Field -->
                            <div class="col-12 mb-3">
                                <label class="form-label" for="manufacturar-name">Sub-Category Name:</label>
                                <input class="form-control @error('category_name') is-invalid @enderror"
                                       id="manufacturar-name"
                                       name="sub_category_name"
                                       type="text"
                                       value="{{ isset($formData) ? $formData->name : old('category_name') }}" />
                                @error('category_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">{{ isset($formData) ? 'Update' : 'Submit' }}</button>
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
                            <th class="text-900 sort" data-sort="name">S.No</th>
                            <th class="text-900 sort" data-sort="name">Name</th>
                            <th class="text-900 sort" data-sort="email">Category Name</th>
                            <th class="text-900 sort" data-sort="status">Status</th>
                            <th class="text-900 sort" data-sort="age">Action</th>
                          </tr>
                        </thead>
                        <tbody class="list">
                            @if($subcategories)
                                @foreach ($subcategories as $index=> $item)

                          <tr>
                            <td class="name">{{ ++$index }}</td>
                            <td class="name">{{ $item->name }}</td>
                            <td class="email">{{ $item->parent->name }}</td>
                            <td class="status">{{ $item->status==1 ? 'Active' : 'Disable' }}</td>
                            <td class="action">
                                <a href="{{ route('subcategory.edit',$item->id) }}" class="badge rounded badge-subtle-info false">Edit</a>
                                <a href="{{ route('subcategory.delete',$item->id) }}" onclick="if(!confirm('Are you sure you want to delete?')) { event.preventDefault(); }" class="badge rounded badge-subtle-danger false">Delete</a>
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
    @endsection
