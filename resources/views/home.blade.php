@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Welcome to E-commerce</h2>
    <p>Explore our products and manage your cart.</p>

    @if(Auth::check())
        @if(Auth::user()->hasRole('Admin'))
            <div class="alert alert-info" role="alert">
                <h4 class="alert-heading">Admin Dashboard</h4>
                <p>As an admin, you can manage products.</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary">Manage Products</a>
            </div>
        @elseif(Auth::user()->hasRole('User'))
            <div class="alert alert-info" role="alert">
                <h4 class="alert-heading">Customer Dashboard</h4>
                <p>As a customer, you can view products and manage your cart.</p>
                <a href="{{ route('cart.index') }}" class="btn btn-primary">View Cart</a>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">View Products</a>
            </div>
        @endif
    @else
        <div class="alert alert-warning" role="alert">
            <h4 class="alert-heading">Welcome!</h4>
            <p>Please log in to access your account and explore our products.</p>
            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
        </div>
    @endif
</div>

@endsection