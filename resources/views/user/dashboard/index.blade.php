@extends('user.layout.template')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/qrious@4.0.2/dist/qrious.min.js"></script>
    <div class="row g-3 mb-3" bis_skin_checked="1">
        <div class="col-sm-6 col-md-6" bis_skin_checked="1">
            <div class="card overflow-hidden" style="min-width: 12rem" bis_skin_checked="1">
                <div class="bg-holder bg-card" style="background-image:url(assets/img/icons/spot-illustrations/corner-1.png);"
                    bis_skin_checked="1"></div><!--/.bg-holder-->
                <div class="card-body position-relative" bis_skin_checked="1">
                    <h6>Earning Point</h6>
                    <div class="display-4 fs-5 mb-2 fw-normal font-sans-serif text-warning"
                        data-countup="{&quot;endValue&quot;:58.386,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}"
                        bis_skin_checked="1">{{ $earning_point }}</div>
                    {{-- <a class="fw-semi-bold fs-10 text-nowrap" href="app/e-commerce/customers.html">See all<svg class="svg-inline--fa fa-angle-right fa-w-8 ms-1" data-fa-transform="down-1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg="" style="transform-origin: 0.25em 0.5625em;"><g transform="translate(128 256)"><g transform="translate(0, 32)  scale(1, 1)  rotate(0 0 0)"><path fill="currentColor" d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z" transform="translate(-128 -256)"></path></g></g></svg></a> --}}
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-6" bis_skin_checked="1">
            <div class="card overflow-hidden" style="min-width: 12rem" bis_skin_checked="1">
                <div class="bg-holder bg-card"
                    style="background-image:url(assets/img/icons/spot-illustrations/corner-2.png);" bis_skin_checked="1">
                </div><!--/.bg-holder-->
                <div class="card-body position-relative" bis_skin_checked="1">
                    <h6>Level Point</h6>
                    <div class="display-4 fs-5 mb-2 fw-normal font-sans-serif text-info"
                        data-countup="{&quot;endValue&quot;:23.434,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}"
                        bis_skin_checked="1">{{ $level_point }}</div>
                    {{-- <a class="fw-semi-bold fs-10 text-nowrap" href="app/e-commerce/orders/order-list.html">All orders<svg class="svg-inline--fa fa-angle-right fa-w-8 ms-1" data-fa-transform="down-1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg="" style="transform-origin: 0.25em 0.5625em;"><g transform="translate(128 256)"><g transform="translate(0, 32)  scale(1, 1)  rotate(0 0 0)"><path fill="currentColor" d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z" transform="translate(-128 -256)"></path></g></g></svg></a> --}}
                </div>
            </div>
        </div>
        <div class
        <div class="col-sm-6 col-md-6" bis_skin_checked="1">
            <div class="card overflow-hidden" style="min-width: 12rem" bis_skin_checked="1">
                <div class="bg-holder bg-card"
                    style="background-image:url(assets/img/icons/spot-illustrations/corner-3.png);" bis_skin_checked="1">
                </div><!--/.bg-holder-->
                <div class="card-body position-relative" bis_skin_checked="1">
                    <h6>Total Orders</h6>
                    <div class="display-4 fs-5 mb-2 fw-normal font-sans-serif"
                        data-countup="{&quot;endValue&quot;:43594,&quot;prefix&quot;:&quot;$&quot;}" bis_skin_checked="1">
                        {{ $orders }}</div>
                    {{-- <a class="fw-semi-bold fs-10 text-nowrap" href="index.html">Statistics<svg class="svg-inline--fa fa-angle-right fa-w-8 ms-1" data-fa-transform="down-1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg="" style="transform-origin: 0.25em 0.5625em;"><g transform="translate(128 256)"><g transform="translate(0, 32)  scale(1, 1)  rotate(0 0 0)"><path fill="currentColor" d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z" transform="translate(-128 -256)"></path></g></g></svg></a> --}}
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-6" bis_skin_checked="1">
            <div class="card overflow-hidden" style="min-width: 12rem" bis_skin_checked="1">
                <div class="bg-holder bg-card"
                    style="background-image:url(assets/img/icons/spot-illustrations/corner-1.png);" bis_skin_checked="1">
                </div><!--/.bg-holder-->
                <div class="card-body position-relative" bis_skin_checked="1">
                    <h6>Subscriptions</h6>
                    <div class="display-4 fs-5 mb-2 fw-normal font-sans-serif text-warning"
                        data-countup="{&quot;endValue&quot;:58.386,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}"
                        bis_skin_checked="1">{{ $subscription ?? 0 }}</div>
                    {{-- <a class="fw-semi-bold fs-10 text-nowrap" href="app/e-commerce/customers.html">See all<svg class="svg-inline--fa fa-angle-right fa-w-8 ms-1" data-fa-transform="down-1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg="" style="transform-origin: 0.25em 0.5625em;"><g transform="translate(128 256)"><g transform="translate(0, 32)  scale(1, 1)  rotate(0 0 0)"><path fill="currentColor" d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z" transform="translate(-128 -256)"></path></g></g></svg></a> --}}
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-6" bis_skin_checked="1">
            <div class="card overflow-hidden" style="min-width: 12rem" bis_skin_checked="1">
                <div class="bg-holder bg-card"
                    style="background-image:url(assets/img/icons/spot-illustrations/corner-3.png);" bis_skin_checked="1">
                </div><!--/.bg-holder-->
                <div class="card-body position-relative" bis_skin_checked="1">
                    <h6>Referral Count</h6>
                    <div class="display-4 fs-5 mb-2 fw-normal font-sans-serif"
                        data-countup="{&quot;endValue&quot;:43594,&quot;prefix&quot;:&quot;$&quot;}" bis_skin_checked="1">
                        {{ $direct_referrals }}</div>
                    {{-- <a class="fw-semi-bold fs-10 text-nowrap" href="index.html">Statistics<svg class="svg-inline--fa fa-angle-right fa-w-8 ms-1" data-fa-transform="down-1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg="" style="transform-origin: 0.25em 0.5625em;"><g transform="translate(128 256)"><g transform="translate(0, 32)  scale(1, 1)  rotate(0 0 0)"><path fill="currentColor" d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z" transform="translate(-128 -256)"></path></g></g></svg></a> --}}
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-6" bis_skin_checked="1">
            <div class="card overflow-hidden" style="min-width: 12rem" bis_skin_checked="1">
                <div class="bg-holder bg-card"
                    style="background-image:url(assets/img/icons/spot-illustrations/corner-3.png);" bis_skin_checked="1">
                </div><!--/.bg-holder-->
                <div class="card-body position-relative" bis_skin_checked="1">
                    <h6>Level Members</h6>
                    <div class="display-4 fs-5 mb-2 fw-normal font-sans-serif"
                        data-countup="{&quot;endValue&quot;:43594,&quot;prefix&quot;:&quot;$&quot;}" bis_skin_checked="1">
                        {{ $total_two_level_referrals }}</div>
                    {{-- <a class="fw-semi-bold fs-10 text-nowrap" href="index.html">Statistics<svg class="svg-inline--fa fa-angle-right fa-w-8 ms-1" data-fa-transform="down-1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg="" style="transform-origin: 0.25em 0.5625em;"><g transform="translate(128 256)"><g transform="translate(0, 32)  scale(1, 1)  rotate(0 0 0)"><path fill="currentColor" d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z" transform="translate(-128 -256)"></path></g></g></svg></a> --}}
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                @php
                    $qrText = url('/') . '/signup/' . $my_code;
                @endphp
                <input type="text" readonly value="{{ url('/') . '/signup/' . $my_code }}" class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <canvas id="qrcode"></canvas>

            </div>
        </div>
    </div>
    <script>
        var qr = new QRious({
            element: document.getElementById('qrcode'),
            value: "{{ $qrText }}",
            size: 200,
            level: 'H' // L, M, Q, H
        });
    </script>
@endsection
