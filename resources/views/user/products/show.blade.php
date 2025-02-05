@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="mb-4">{{ $product->name }}</h3>

        <div class="card">
            <div class="card-body">
                <p><strong>Description:</strong> {{ $product->description }}</p>
                <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>

                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Add to Cart</button>
                </form>

                <a href="{{ route('user.products.index') }}" class="btn btn-secondary mt-3">Back to Products</a>
            </div>
        </div>
    </div>
@endsection
