@extends('index')
@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-success text-white">
                    Order Confirmation
                </div>
                <div class="card-body">
                    <h4 class="mb-4">Thank you for your order!</h4>
                    <p>Your order #{{ $order['order_id'] }} has been received and is being processed.</p>
                    
                    <a href="{{ route('products.allproduct') }}" class="btn btn-primary mt-4">Continue Shopping</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
