@extends('index')
@section('content')
    <div class="section">
        <div class="container">



            <div class="row g-5">
                <div class="col-md-5 col-lg-4 order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-danger">Your cart</span>
                        <span class="badge bg-danger rounded-pill">3</span>
                    </h4>
                    <ul class="list-group mb-3">
                        @foreach ($cartItems as $item)
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                    <h6 class="my-0">{{ $item->product->product_name }}</h6>
                                    <small class="text-muted">Quantity : {{ $item->quantity ?? '' }}</small>
                                </div>
                                <span
                                    class="text-muted">${{ number_format($item->product->product_price * $item->quantity, 2) }}</span>
                            </li>
                        @endforeach

                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <div class="text-success">
                                <h6 class="my-0">Shipping</h6>

                            </div>
                            <span class="text-success">+${{ $shipping }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <div class="text-success">
                                <h6 class="my-0">Tax</h6>

                            </div>
                            <span class="text-success">+${{ $tax }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (USD)</span>
                            <strong>${{ $total }}</strong>
                        </li>
                    </ul>

                </div>
                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">Billing address</h4>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form onsubmit="return false;" class="needs-validation" id="checkout" method="POST"
                        action="{{ route('cart.processCheckout') }}" novalidate>
                        @csrf
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="firstName" class="form-label">First name</label>
                                <input type="text" class="form-control @error('firstName') is-invalid @enderror"
                                    id="firstName" name="firstName" value="{{ old('firstName') }}" required>
                                @error('firstName')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="lastName" class="form-label">Last name</label>
                                <input type="text" class="form-control @error('lastName') is-invalid @enderror"
                                    id="lastName" name="lastName" value="{{ old('lastName') }}" required>
                                @error('lastName')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                           
                            <div class="col-12">
                                <label for="email" class="form-label">Email <span
                                        class="text-muted">(Optional)</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}"
                                    placeholder="you@example.com">
                                @error('email')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror"
                                    id="address" name="address" value="{{ old('address') }}" required>
                                @error('address')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="address2" class="form-label">Address 2 <span
                                        class="text-muted">(Optional)</span></label>
                                <input type="text" class="form-control" id="address2" name="address2"
                                    value="{{ old('address2') }}" placeholder="Apartment or suite">
                            </div>
                            <div class="col-md-5">
                                <label for="country" class="form-label">Country</label>
                                <select class="form-select @error('country') is-invalid @enderror" id="country"
                                    name="country" required>
                                    <option value="">Choose...</option>
                                    <option value="United States"
                                        {{ old('country') == 'United States' ? 'selected' : '' }}>United States</option>
                                </select>
                                @error('country')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="state" class="form-label">State</label>
                                <select class="form-select @error('state') is-invalid @enderror" id="state"
                                    name="state" required>
                                    <option value="">Choose...</option>
                                    <option value="California" {{ old('state') == 'California' ? 'selected' : '' }}>
                                        California</option>
                                </select>
                                @error('state')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="zip" class="form-label">Zip</label>
                                <input type="text" class="form-control @error('zip') is-invalid @enderror"
                                    id="zip" name="zip" value="{{ old('zip') }}" required>
                                @error('zip')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="same-address" name="same_address"
                                {{ old('same_address') ? 'checked' : '' }}>
                            <label class="form-check-label" for="same-address">Shipping address is the same as my billing
                                address</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="save-info" name="save_info"
                                {{ old('save_info') ? 'checked' : '' }}>
                            <label class="form-check-label" for="save-info">Save this information for next time</label>
                        </div>
                        <hr class="my-4">
                        <h4 class="mb-3">Payment</h4>


                        <hr class="my-4">
                        <button class="w-100 btn btn-danger btn-lg mb-5" type="submit">Continue to checkout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        // jQuery Validation
    $("#checkout").validate({
        rules: {
            firstName: { required: true },
            lastName: { required: true },
            username: { required: true },
            email: { email: true },
            address: { required: true },
            country: { required: true },
            state: { required: true },
            zip: { required: true }
        },
        messages: {
            firstName: {
                required: "Please enter your first name"
            },
            lastName: {
                required: "Please enter your last name"
            },
            username: {
                required: "Please enter your username"
            },
            email: {
                email: "Please enter a valid email address"
            },
            address: {
                required: "Please enter your address"
            },
            country: {
                required: "Please select your country"
            },
            state: {
                required: "Please select your state"
            },
            zip: {
                required: "Please enter your zip code"
            }
        },
        errorElement: 'div',
        errorClass: 'invalid-feedback d-block',
        highlight: function(element) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element) {
            $(element).removeClass('is-invalid');
        },
        errorPlacement: function(error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form) {
            $('.loader-overlay').css('display', 'block');
            form.submit();
        }
    });
    </script>

@endsection
