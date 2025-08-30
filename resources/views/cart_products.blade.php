@extends('index')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <div class="section">
        <div class="container py-5">
            <h2 class="mb-5">Your Shopping Cart</h2>
            <div class="row">
                <div class="col-lg-8">
                    <!-- Cart Items -->
                    <div class="card mb-4">
                        <div class="card-body">
                            @if($cartItems->isEmpty())
                                <div class="text-center">
                                    <h5 class="mb-3">Your cart is empty</h5>
                                    <p class="text-muted">Add items to your cart to proceed with checkout.</p>
                                    <a href="{{ route('user.index') }}" class="btn btn-outline-danger">
                                        <i class="bi bi-arrow-left me-2"></i>Continue Shopping
                                    </a>
                                </div>
                            @else
                                <h5 class="mb-4">Items in your cart</h5>
                                @php
                                    $subtotal = 0;
                                    $tax = 0;
                                    $total = 0;
                                @endphp
                                    @foreach($cartItems as $item)
                                        @php
                                            $itemPrice = $item->product->product_price * $item->quantity;
                                            $subtotal += $itemPrice;
                                            $tax += $itemPrice * 0.1; // Assuming a 10% tax rate
                                            $total = $subtotal + $tax + 10; // Adding a flat shipping fee of $10
                                        @endphp
                                                <div class="row cart-item mb-3">
                                                    <div class="col-md-3">
                                                        <img src="{{ asset($item->product->productImages[0]->image_path) }}" alt="Product 1" class="img-fluid rounded">
                                                    </div>
                                                    <div class="col-md-5">
                                                        <h5 class="card-title">{{ $item->product->product_name }}</h5>
                                                <p class="text-muted">Category: {{ $item->product->category->name }} {{ isset($item->product->subcategory->name) ?? "/". $item->product->subcategory->name }}</p>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="input-group">
                                                            <button 
                                                                class="btn btn-outline-secondary btn-sm update-qty" 
                                                                type="button" 
                                                                data-id="{{ $item->id }}" 
                                                                data-type="decrease"
                                                                {{ $item->quantity <= 1 ? 'disabled' : '' }}
                                                            >-</button>

                                                            <input style="max-width:100px" type="text" class="form-control form-control-sm text-center quantity-input item-qty-{{ $item->id }}" value="{{ $item->quantity }}" readonly>

                                                            <button 
                                                                class="btn btn-outline-secondary btn-sm update-qty" 
                                                                type="button" 
                                                                data-id="{{ $item->id }}" 
                                                                data-type="increase"
                                                                {{ $item->quantity >= $item->product->product_stock ? 'disabled' : '' }}
                                                            >+</button>
                                                        </div>
                                                                                                    </div>
                                                    <div class="col-md-2 text-end">
                                                    <input style="max-width:100px" type="text"
                                                            class="form-control form-control-sm text-center quantity-input item-qty-{{ $item->id }}"
                                                            value="{{ $item->quantity }}" readonly>

                                                        <p class="fw-bold item-price item-price-{{ $item->id }}">${{ number_format($item->product->product_price * $item->quantity, 2) }}</p>

                                                        <button class="btn btn-sm btn-outline-danger remove-item" data-id="{{ $item->id }}">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            <hr>
                                    @endforeach
                                    @endif
                        </div>
                    </div>
                    <!-- Continue Shopping Button -->
                    {{-- <div class="card mt-4">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Apply Promo Code</h5>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Enter promo code">
                                <button class="btn btn-outline-secondary" type="button">Apply</button>
                            </div>
                        </div>
                    </div> --}}
                    <div class="text-start mb-4">
                        <a href="{{ route('products.allproduct') }}" class="btn btn-outline-danger">
                            <i class="bi bi-arrow-left me-2"></i>Continue Shopping
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    
                    <!-- Cart Summary -->
                    <div class="card cart-summary">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Order Summary</h5>
                            <div class="d-flex justify-content-between mb-3">
                                <span>Subtotal</span>
                                <span id="subtotal">${{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span>Shipping</span>
                                <span>$10.00</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span>Tax</span>
                                <span id="tax">${{ number_format($tax, 2) }}</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-4">
                                <strong>Total</strong>
                                <strong id="total">${{ number_format($total, 2) }}</strong>
                            </div>
                            <button class="btn btn-danger w-100 redirectToCheckout">Proceed to Checkout</button>
                        </div>
                    </div>
                    <!-- Promo Code -->
                
                </div>
            </div>
        </div>
    </div>

   <script>
    $(document).ready(function () {

        // Update Quantity
        $('.update-qty').on('click', function () {
            let button = $(this);
            let cartItemId = button.data('id');
            let action = button.data('type');

            $.ajax({
                url: "{{ route('cart.updateQuantity') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: cartItemId,
                    action: action
                },
                success: function (res) {
                    if (res.success) {
                        $('.item-qty-' + cartItemId).val(res.itemQty);
                        $('.item-price-' + cartItemId).text('$' + res.itemPrice);
                        $('#subtotal').text('$' + res.subtotal);
                        $('#tax').text('$' + res.tax);
                        $('#total').text('$' + res.total);
                    }
                },
                error: function (xhr) {
                    alert('Error updating quantity');
                }
            });
        });

        // Remove Item
        $('.remove-item').on('click', function () {
            let cartItemId = $(this).data('id');

            $.ajax({
                url: "{{ route('cart.removeItem') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: cartItemId
                },
                success: function (res) {
                    if (res.success) {
                        $('.cart-item:has(button[data-id="' + cartItemId + '"])').remove();

                        $('#subtotal').text('$' + res.subtotal);
                        $('#tax').text('$' + res.tax);
                        $('#total').text('$' + res.total);

                        // Optional: show empty message if cart is now empty
                        if (res.cartEmpty) {
                            location.reload();
                        }
                    }
                },
                error: function () {
                    alert('Error removing item');
                }
            });
        });

    });

    $(".redirectToCheckout").on("click", function() {
        window.location.href = "{{ route(name: 'cart.checkout') }}";
    });
</script>



@endsection