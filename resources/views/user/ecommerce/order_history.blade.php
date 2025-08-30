@extends('user.layout.template')
@section('content')
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
                            <th class="text-900 sort" data-sort="email">Order ID</th>
                            <th class="text-900 sort" data-sort="status">Date</th>
                            <th class="text-900 sort" data-sort="age">Amount</th>
                            <th class="text-900 sort" data-sort="age">Status</th>
                            <th class="text-900 sort" data-sort="age">Action</th>
                          </tr>
                        </thead>
                        <tbody class="list">
                            @if($orders)
                                @foreach ($orders as $item)

                          <tr>
                            <td class="name">{{ $loop->iteration }}</td>
                            <td class="email">{{ $item->order_id }}</td>
                            <td class="status">{{ $item->created_at }}</td>
                            <td class="action">{{ "$".$item->amount }}</td>
                            <td class="action">
                              @if($item->status == 'paid')
                                <span class="badge bg-success">Paid</span>
                              @elseif($item->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                              @else
                                <span class="badge bg-danger">Failed</span>
                              @endif
                            </td>
                            <td><a href="{{ route('order.invoice',$item->order_id) }}" class="badge bg-warning">View Invoice</a></td>
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
