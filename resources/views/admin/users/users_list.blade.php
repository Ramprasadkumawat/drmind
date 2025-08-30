@extends('admin.layout.template')
@section('content')
<div class="card mb-3">
    <div class="card-body">
        <div class="row flex-between-center">
            <div class="col-md">
                <h5 class="mb-2 mb-md-0">View a Users list</h5>
            </div>
            <div class="row g-0">
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
                                <thead>
                                    <tr>
                                      <th>
                                          <span class="f-light f-w-600">S.No</span>
                                      </th>
                                      <th> <span class="f-light f-w-600">User Name</span></th>
                                      <th> <span class="f-light f-w-600">Contact Number</span></th>
                                      <th> <span class="f-light f-w-600">Email</span></th>
                                      <th> <span class="f-light f-w-600">Wallet Amount</span></th>
                                      <th> <span class="f-light f-w-600">Members</span></th>
                                      <th> <span class="f-light f-w-600">Level</span></th>
                                      <th> <span class="f-light f-w-600">Orders</span></th>
                                      <th> <span class="f-light f-w-600">Action</span></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($users as $index => $user)
                                    <tr class="product-removes">
                                      <td>{{ $index + 1 }}</td>
                                      <td><p>{{ $user->name }}</p></td>
                                      <td><p class="f-light">{{ $user->phone ?? '-' }}</p></td>
                                      <td><p class="f-light">{{ $user->email }}</p></td>
                                      <td><p class="f-light">${{ number_format($user->earning_point, 2) }}</p></td>
                                      <td><p class="f-light">{{ $user->directMembers }}</p></td>
                                      <td>
                                        <span class="badge badge-light-secondary">
                                          <p>
                                            <span class="f-light" style="color:black">Level 1:</span> <span class="badge bg-success">{{ $user->level1 }}</span> <br/>
                                            <span class="f-light" style="color:black">Level 2:</span> <span class="badge bg-success">{{ $user->level2 }}</span> <br/>
                                            <span class="f-light" style="color:black">Level 3:</span> <span class="badge bg-success">{{ $user->level3 }}</span>
                                          </p>
                                        </span>
                                      </td>
                                      <td>0</td>
                                      <td>
                                        <a href="{{ url('/user-referral/' . $user->referral_code) }}" class="badge rounded badge-subtle-info false">View Level</a>
                                     
                                      </td>
                                    </tr>
                                    @endforeach
                  
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
        </div>
    </div>
</div>
@endsection
