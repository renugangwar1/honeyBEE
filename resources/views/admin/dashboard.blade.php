@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold text-dark text-center">💄 Makeup Brand Admin Dashboard</h2>

    {{-- 🔹 Summary Cards --}}
    <div class="row g-4 mb-5">
        {{-- Products --}}
        <div class="col-md-3">
            <div class="card text-white bg-primary shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <i class="bi bi-box-seam display-6"></i>
                    <h5 class="fw-bold mt-2">Products</h5>
                    <p class="display-6">{{ \App\Models\Product::count() }}</p>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-light btn-sm">Manage</a>
                </div>
            </div>
        </div>

        {{-- Categories --}}
        <div class="col-md-3">
            <div class="card text-white bg-success shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <i class="bi bi-tags display-6"></i>
                    <h5 class="fw-bold mt-2">Categories</h5>
                    <p class="display-6">{{ \App\Models\Category::count() }}</p>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-light btn-sm">Manage</a>
                </div>
            </div>
        </div>

        {{-- Users --}}
        <div class="col-md-3">
            <div class="card text-white bg-warning shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <i class="bi bi-people-fill display-6"></i>
                    <h5 class="fw-bold mt-2">Users</h5>
                    <p class="display-6">{{ \App\Models\User::count() }}</p>
                    <a href="#" class="btn btn-light btn-sm">Manage</a>
                </div>
            </div>
        </div>

        {{-- Orders --}}
        <div class="col-md-3">
            <div class="card text-white bg-danger shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <i class="bi bi-cart-fill display-6"></i>
                    <h5 class="fw-bold mt-2">Orders</h5>
                    <p class="display-6">0</p>
                    <a href="#" class="btn btn-light btn-sm">View</a>
                </div>
            </div>
        </div>

        {{-- Banners --}}
        <div class="col-md-3">
            <div class="card text-white bg-info shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <i class="bi bi-images display-6"></i>
                    <h5 class="fw-bold mt-2">Banners</h5>
                    <p class="display-6">{{ \App\Models\Banner::count() }}</p>
                    <a href="{{ route('admin.banners.index') }}" class="btn btn-light btn-sm">Manage</a>
                </div>
            </div>
        </div>
    </div>

    {{-- 🔹 Quick Actions --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h4 class="fw-bold mb-3 text-center">Quick Actions</h4>
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="{{ route('admin.products.create') }}" class="btn btn-outline-primary btn-lg">➕ Add Product</a>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-outline-success btn-lg">➕ Add Category</a>
                <a href="{{ route('admin.banners.create') }}" class="btn btn-outline-info btn-lg">➕ Add Banner</a>
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-dark btn-lg">📦 View Products</a>
            </div>
        </div>
    </div>
</div>

{{-- Optional Custom CSS --}}
<style>
    body {
        background: #fff0f5; /* subtle makeup-themed background */
    }

    .card i {
        font-size: 3rem;
        margin-bottom: 10px;
    }

    .card:hover {
        transform: translateY(-5px);
        transition: 0.3s;
    }

    .btn-outline-primary {
        color: #fff;
        border-color: #ff69b4;
        background: linear-gradient(45deg, #ff69b4, #ff1493);
    }

    .btn-outline-primary:hover {
        color: #fff;
        background: linear-gradient(45deg, #ff1493, #ff69b4);
    }

    .btn-outline-success {
        color: #fff;
        border-color: #32cd32;
        background: linear-gradient(45deg, #32cd32, #228b22);
    }

    .btn-outline-success:hover {
        background: linear-gradient(45deg, #228b22, #32cd32);
    }

    .btn-outline-info {
        color: #fff;
        border-color: #00ced1;
        background: linear-gradient(45deg, #00ced1, #20b2aa);
    }

    .btn-outline-info:hover {
        background: linear-gradient(45deg, #20b2aa, #00ced1);
    }

    .btn-outline-dark {
        color: #fff;
        border-color: #6a0dad;
        background: linear-gradient(45deg, #6a0dad, #8b008b);
    }

    .btn-outline-dark:hover {
        background: linear-gradient(45deg, #8b008b, #6a0dad);
    }
</style>
@endsection
