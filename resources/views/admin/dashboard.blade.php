@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container py-5">
    <!-- Dashboard Title -->
    <h2 class="mb-5 fw-bold text-center text-primary">
        💄 Makeup Brand Admin Dashboard
    </h2>

    {{-- 🔹 Summary Cards --}}
    <div class="row g-4 mb-5">
        {{-- Products --}}
        <div class="col-md-3">
            <div class="dashboard-card h-100">
                <div class="card-body text-center">
                    <i class="bi bi-box-seam text-primary"></i>
                    <h5 class="fw-bold mt-3">Products</h5>
                    <p class="stat-number">{{ \App\Models\Product::count() }}</p>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-primary btn-sm rounded-pill">Manage</a>
                </div>
            </div>
        </div>

        {{-- Categories --}}
        <div class="col-md-3">
            <div class="dashboard-card h-100">
                <div class="card-body text-center">
                    <i class="bi bi-tags text-secondary"></i>
                    <h5 class="fw-bold mt-3">Categories</h5>
                    <p class="stat-number">{{ \App\Models\Category::count() }}</p>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">Manage</a>
                </div>
            </div>
        </div>

        {{-- Users --}}
        <div class="col-md-3">
            <div class="dashboard-card h-100">
                <div class="card-body text-center">
                    <i class="bi bi-people-fill text-primary"></i>
                    <h5 class="fw-bold mt-3">Users</h5>
                    <p class="stat-number">{{ \App\Models\User::count() }}</p>
                    <a href="#" class="btn btn-outline-primary btn-sm rounded-pill">Manage</a>
                </div>
            </div>
        </div>

        {{-- Orders --}}
        <div class="col-md-3">
            <div class="dashboard-card h-100">
                <div class="card-body text-center">
                    <i class="bi bi-cart-fill text-secondary"></i>
                    <h5 class="fw-bold mt-3">Orders</h5>
                    <p class="stat-number">{{ \App\Models\Order::count() }}</p>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">View</a>
                </div>
            </div>
        </div>

        {{-- Banners --}}
        <div class="col-md-3">
            <div class="dashboard-card h-100">
                <div class="card-body text-center">
                    <i class="bi bi-images text-primary"></i>
                    <h5 class="fw-bold mt-3">Banners</h5>
                    <p class="stat-number">{{ \App\Models\Banner::count() }}</p>
                    <a href="{{ route('admin.banners.index') }}" class="btn btn-outline-primary btn-sm rounded-pill">Manage</a>
                </div>
            </div>
        </div>
    </div>

    {{-- 🔹 Quick Actions --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body text-center">
            <h4 class="fw-bold mb-4 text-primary">⚡ Quick Actions</h4>
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-lg rounded-pill">➕ Add Product</a>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-secondary btn-lg rounded-pill">➕ Add Category</a>
                <a href="{{ route('admin.banners.create') }}" class="btn btn-primary btn-lg rounded-pill">➕ Add Banner</a>
                <a href="{{ route('admin.products.index') }}" class="btn btn-dark btn-lg rounded-pill">📦 View Products</a>
            </div>
        </div>
    </div>
</div>

{{-- Custom CSS --}}
<style>
    body {
        background: #f9f9fc; /* very light gray with purple tone */
        font-family: 'Poppins', sans-serif;
    }

    /* Dashboard Cards */
    .dashboard-card {
        border-radius: 1rem;
        padding: 1.5rem;
        background: #fff;
        box-shadow: 0 6px 15px rgba(0,0,0,0.05);
        transition: all 0.3s ease-in-out;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.12);
    }

    .dashboard-card i {
        font-size: 2.5rem;
        margin-bottom: 10px;
    }

    .stat-number {
        font-size: 1.8rem;
        font-weight: 700;
        margin: 0.5rem 0 1rem 0;
        color: #333;
    }

    /* Buttons */
    .btn-lg {
        padding: 0.6rem 1.4rem;
        font-size: 1rem;
        font-weight: 600;
    }
</style>
@endsection
