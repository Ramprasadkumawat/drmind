@extends('admin.layout.template')
@section('content')
<div class="card mb-3">
      <div class="card-body">
        <div class="row flex-between-center">
          <div class="col-md">
            <h5 class="mb-2 mb-md-0">View Blogs</h5>
            @if(session('success'))
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
                            <th class="text-900 sort" data-sort="name">Image</th>
                            <th class="text-900 sort" data-sort="email">Title</th>
                            <th class="text-900 sort" data-sort="email">URL</th>
                            <th class="text-900 sort" data-sort="email">Status</th>
                            <th class="text-900 sort" data-sort="email">Created At</th>

                            <th class="text-900 sort" data-sort="age">Action</th>
                          </tr>
                        </thead>
                        <tbody class="list">
                            @if($bloglist)
                                @foreach ($bloglist as $item)

                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="name">@if($item->image)  <img src="{{ asset($item->image); }}" width="80px" height="100px"> @else {{'No-image'}} @endif </td>
                            <td class="email">{{ $item->title }}</td>
                            <td class="email"><a href="{{ route('home.blog-details',['slug'=> $item->slug])}}" target="_blank">{{ route('home.blog-details',['slug'=> $item->slug])}}</a></td>
                            
                            
                            <td class="status">{{ ucfirst($item->status) }}</td>
                            <td class="status">{{ $item->created_at }}</td>
                            
                            <td class="action">
                                <a href="javascript:;" title="Under Development" class="badge bg-info">Edit</a>
                                <a href="{{ route('home.blog-details',['slug'=> $item->slug])}}"  target="_blank" title="Under Development" class="badge bg-info">View</a>
                                <form action="#" method="POST" style="display:inline; display:none;">
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
@endsection
