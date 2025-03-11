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
    </div>
</div>
@endsection