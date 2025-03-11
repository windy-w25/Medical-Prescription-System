@extends('products.layout')
@section('content')
<div class="container">
    <h1>Dashboard</h1>

    <div class="row">
        <!-- Product Count Box -->
        <div class="col-md-4">
            <div class="card bg-primary text-white mb-3">
                <div class="card-body">
                    <h4 class="card-title">Products</h4>
                    <p class="card-text">Total: {{ $productCount }}</p>
                    <a href="{{ route('products.index') }}" class="btn btn-light">View Products</a>
                </div>
            </div>
        </div>

        <!-- Category Count Box -->
        <div class="col-md-4">
            <div class="card bg-success text-white mb-3">
                <div class="card-body">
                    <h4 class="card-title">Categories</h4>
                    <p class="card-text">Total: {{ $categoryCount }}</p>
                    <a href="{{ route('categories.index') }}" class="btn btn-light">View Categories</a>
                </div>
            </div>
        </div>

        <!-- Add more count boxes as needed -->
    </div>
</div>
@endsection