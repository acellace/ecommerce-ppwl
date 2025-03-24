@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Your Cart</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($carts as $cart)
                <tr>
                    <td>{{ $cart->product->name }}</td>
                    <td>
                        <form action="{{ route('cart.update', $cart->id) }}" method="POST">
                            @csrf
                            <input type="number" name="quantity" value="{{ $cart->quantity }}" min="1">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('cart.remove', $cart->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection