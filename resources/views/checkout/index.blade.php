@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="mb-4">Checkout</h3>

        <div class="card">
            <div class="card-header">
                <h5>Review Your Order</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartItems as $item)
                            <tr>
                                <td>{{ $item->product->name }}</td>
                                <td>${{ number_format($item->product->price, 2) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('cart.index') }}" class="btn btn-secondary">Back to Cart</a>
                    <a href="#" class="btn btn-primary float-end">Proceed with Payment</a>
                </div>
            </div>
        </div>
    </div>
@endsection
