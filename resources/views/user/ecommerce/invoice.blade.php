@extends('user.layout.template')
@section('content')
        <div class="card mb-3">
            <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../../../assets/img/icons/spot-illustrations/corner-4.png);opacity: 0.7;"></div><!--/.bg-holder-->
            <div class="card-body position-relative">
              <h5>Order Details: #{{ $order->order_id }}</h5>
              <p class="fs-10">{{ $order->created_at }}</p>
              <div><strong class="me-2">Status: </strong>
                @if($order->status === 'completed')
                    <div class="badge rounded-pill badge-subtle-success fs-11">
                        Completed
                        <svg class="svg-inline--fa fa-check fa-w-16 ms-1" data-fa-transform="shrink-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="" style="transform-origin: 0.5em 0.5em;"><g transform="translate(256 256)"><g transform="translate(0, 0)  scale(0.875, 0.875)  rotate(0 0 0)"><path fill="currentColor" d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z" transform="translate(-256 -256)"></path></g></g></svg>
                    </div>
                @elseif($order->status === 'pending')
                    <div class="badge rounded-pill badge-subtle-warning fs-11">
                        Pending
                        <svg class="svg-inline--fa fa-clock fa-w-16 ms-1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="clock" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="transform-origin: 0.5em 0.5em;"><g transform="translate(256 256)"><g transform="translate(0, 0)  scale(0.875, 0.875)  rotate(0 0 0)"><path fill="currentColor" d="M256 8C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm0 448c-110.532 0-200-89.468-200-200S145.468 56 256 56s200 89.468 200 200-89.468 200-200 200zm12-200V136c0-6.627-5.373-12-12-12h-16c-6.627 0-12 5.373-12 12v124c0 6.627 5.373 12 12 12h88c6.627 0 12-5.373 12-12v-16c0-6.627-5.373-12-12-12h-76z" transform="translate(-256 -256)"></path></g></g></svg>
                    </div>
                @elseif($order->status === 'cancelled')
                    <div class="badge rounded-pill badge-subtle-danger fs-11">
                        Cancelled
                        <svg class="svg-inline--fa fa-times fa-w-16 ms-1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" style="transform-origin: 0.5em 0.5em;"><g transform="translate(176 256)"><g transform="translate(0, 0)  scale(0.875, 0.875)  rotate(0 0 0)"><path fill="currentColor" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.19 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.19 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z" transform="translate(-176 -256)"></path></g></g></svg>
                    </div>
                @else
                    <div class="badge rounded-pill badge-subtle-secondary fs-11">
                        {{ ucfirst($order->status) }}
                    </div>
                @endif
              </div>
            </div>
          </div>

          <div class="card mb-3">
            <div class="card-body">
              <div class="row">
                <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                  <h5 class="mb-3 fs-9">Billing Address</h5>
                  <h6 class="mb-2">{{ $order->customer_name ?? '' }}</h6>
                  <p class="mb-1 fs-10">
                    {{ $address['address1'] ?? '' }}
                    @if(!empty($address['address2']))
                      <br>{{ $address['address2'] }}
                    @endif
                    <br>{{ $address['state'] ?? '' }}, {{ $address['country'] ?? '' }} {{ $address['zip'] ?? '' }}
                  </p>
                  <p class="mb-0 fs-10"> <strong>Email: </strong>
                    <a href="mailto:{{ $order->email ?? '' }}">{{ $order->email ?? '' }}</a>
                  </p>
                  <p class="mb-0 fs-10"> <strong>Phone: </strong>
                    <a href="tel:{{ $order->phone ?? '' }}">{{ $order->phone ?? '' }}</a>
                  </p>
                </div>
                <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                  <h5 class="mb-3 fs-9">Shipping Address</h5>
                  <h6 class="mb-2">{{ $address->first_name ?? '' }} {{ $address->last_name ?? '' }}</h6>
                  <p class="mb-0 fs-10">
                    {{ $address['address1'] ?? '' }}
                    @if(!empty($address['address2']))
                      <br>{{ $address['address2'] }}
                    @endif
                    <br>{{ $address['state'] ?? '' }}, {{ $address['country'] ?? '' }} {{ $address['zip'] ?? '' }}
                  </p>
                  <div class="text-500 fs-10">(Free Shipping)</div>
                </div>
                <div class="col-md-6 col-lg-4">
                  <h5 class="mb-3 fs-9">Payment Method</h5>
                  <div class="d-flex"><img class="me-3" src="../../../assets/img/icons/visa.png" width="40" height="30" alt="">
                    <div class="flex-1">
                      <h6 class="mb-0">{{ $order->payment_method ?? 'N/A' }}</h6>
                      <p class="mb-0 fs-10">{{ $order->customer_name ?? 'N/A' }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        @php
            // Decode products JSON if it's a string
            
            $subtotal = 0;
        @endphp
        <div class="card mb-3">
            <div class="card-body">
                <div class="table-responsive fs-10">
                    <table class="table table-striped border-bottom">
                        <thead class="bg-200">
                            <tr>
                                <th class="text-900 border-0">Products</th>
                                <th class="text-900 border-0 text-center">Quantity</th>
                                <th class="text-900 border-0 text-end">Rate</th>
                                <th class="text-900 border-0 text-end">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                @php
                                    $price = $product['product_price'];
                                    $quantity = $product['quantity'];
                                    $amount = $quantity * $price;
                                    $subtotal += $amount;
                                @endphp
                                <tr class="border-200">
                                    <td class="align-middle">
                                        <h6 class="mb-0 text-nowrap">{{ $product['product_name'] ?? '' }}</h6>
                                        @if(!empty($product['description']))
                                            <p class="mb-0">{{ $product['description'] }}</p>
                                        @endif
                                    </td>
                                    <td class="align-middle text-center">{{ $quantity }}</td>
                                    <td class="align-middle text-end">${{ number_format($price, 2) }}</td>
                                    <td class="align-middle text-end">${{ number_format($amount, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @php
                    $taxRate = 0.05;
                    $tax = $subtotal * $taxRate;
                    $total = $subtotal + $tax;
                @endphp
                <div class="row g-0 justify-content-end">
                    <div class="col-auto">
                        <table class="table table-sm table-borderless fs-10 text-end">
                            <tbody>
                                <tr>
                                    <th class="text-900">Subtotal:</th>
                                    <td class="fw-semi-bold">${{ number_format($subtotal, 2) }}</td>
                                </tr>
                                <tr>
                                    <th class="text-900">Tax 5%:</th>
                                    <td class="fw-semi-bold">${{ number_format($tax, 2) }}</td>
                                </tr>
                                <tr class="border-top">
                                    <th class="text-900">Total:</th>
                                    <td class="fw-semi-bold">${{ number_format($total, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

@endsection