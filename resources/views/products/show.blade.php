@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $product->name }}</h2>
    <p>{{ $product->description }}</p>
    <p>Price: {{ $product->price }}</p>
    <form action="{{ route('cart.add', $product->id) }}" method="POST">
        @csrf
        <input type="number" name="quantity" value="1" min="1">
        <button type="submit" class="btn btn-primary">Add to Cart</button>
    </form>
</div>
@endsection