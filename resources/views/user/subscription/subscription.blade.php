@extends('user.layout.template')
@section('content')
    <div class="row g-3 mb-3" bis_skin_checked="1">
       <div class="col-lg-12" bis_skin_checked="1">
          @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
          @if(session('error'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
       </div>
    </div>
    <div class="row g-3 mb-3" bis_skin_checked="1">
        
        <div class="col-lg-12" bis_skin_checked="1">
            <div class="card h-100" id="paymentHistoryTable"
                data-list="{&quot;valueNames&quot;:[&quot;course&quot;,&quot;invoice&quot;,&quot;date&quot;,&quot;amount&quot;,&quot;status&quot;],&quot;page&quot;:5}"
                bis_skin_checked="1">
                <div class="card-header d-flex flex-between-center" bis_skin_checked="1">
                    <h5 class="mb-0 text-nowrap py-2 py-xl-0">Payment History</h5>
                    
                </div>
                <div class="card-body p-0" bis_skin_checked="1">
                    <div class="table-responsive scrollbar" bis_skin_checked="1">
                        <table class="table mb-0 fs-10 border-200 overflow-hidden">
                            <thead class="bg-body-tertiary font-sans-serif">
                                <tr>
                                    <th class="text-900 sort align-middle fw-medium" data-sort="course">Course</th>
                                    <th class="text-900 sort align-middle fw-medium" data-sort="invoice">Invoice no.</th>
                                    <th class="text-900 sort align-middle fw-medium" data-sort="date">Date</th>
                                    <th class="text-900 sort align-middle fw-medium text-end" data-sort="amount">Amount
                                    </th>
                                    <th class="text-900 sort align-middle fw-medium text-end" data-sort="status">Payment
                                        Status</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                              @if($subscriptions->count() > 0)
                                @foreach($subscriptions as $subscription)
                                <tr class="fw-semi-bold">
                                    <td class="align-middle pe-5 py-3 course"><a
                                            href="javascript:;">{{ $subscription->plan_name }}</a></td>
                                    <td class="align-middle white-space-nowrap pe-6 py-3 invoice">#{{ $subscription->invoice_number }}</td>
                                    <td class="align-middle white-space-nowrap pe-6 py-3 date">{{ $subscription->starts_at}}</td>
                                    <td class="align-middle white-space-nowrap py-3 text-end amount">{{ $subscription->product_price}}</td>
                                    <td class="align-middle text-end fw-medium font-sans-serif py-3 status text-warning">
                                      {{ $subscription->stripe_status == 'active' ? 'Active' : 'Inactive' }}
                                        </td>
                                </tr>
                                @endforeach
                               @else
                                <tr>
                                    <td colspan="5" class="text-center py-3 text-danger"><h3>No subscriptions found</h3>.</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
@endsection
