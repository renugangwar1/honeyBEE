@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold text-center mb-5">{{ $category->name }}</h2>

    @if($products->count())
    <div class="row g-4">
        @foreach($products as $product)
        <div class="col-6 col-md-4 col-lg-3">
            <div class="product-card position-relative rounded-4 overflow-hidden shadow-lg h-100 d-flex flex-column">

                <!-- Product Image -->
                <div class="position-relative overflow-hidden product-img-wrapper">
                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}"
                        class="w-100 product-img">

                    <!-- Hover Overlay -->
                    <div class="product-overlay d-flex flex-column align-items-center justify-content-center">
                        <a href="{{ url('/products/'.$product->id) }}" class="btn btn-white btn-sm mb-2">
                            <i class="fas fa-eye"></i> View
                        </a>
                    </div>
                </div>

                <!-- Card Body -->
               <!-- Card Body -->
<div class="card-body text-center py-3 flex-grow-1 d-flex flex-column justify-content-between">
    <h5 class="fw-semibold mb-2 product-title">{{ $product->name }}</h5>
    <span class="product-price">₹{{ number_format($product->price, 2) }}</span>
</div>

            </div>
        </div>
        @endforeach
    </div>
    @else
    <p class="text-center fs-5">No products available in this category.</p>
    @endif
</div>
@endsection

@push('styles')
<style>
/* Product card styling */
.product-card {
    background: #fff;
    border-radius: 1rem;
    overflow: hidden;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
    display: flex;
    flex-direction: column;
    height: 100%;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

.product-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 24px rgba(0,0,0,0.15);
}

/* Image wrapper */
.product-img-wrapper {
    height: 260px; /* taller ratio for product visibility */
    overflow: hidden;
    border-bottom: 1px solid #eee;
    background: #fafafa;
}

.product-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.product-card:hover .product-img {
    transform: scale(1.08);
}

/* Hover overlay */
.product-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.45);
    opacity: 0;
    transition: opacity 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.product-card:hover .product-overlay {
    opacity: 1;
}

/* Overlay button */
.product-overlay .btn-white {
    background-color: #fff;
    color: #333;
    font-weight: 600;
    border-radius: 50px;
    padding: 0.45rem 1rem;
    font-size: 0.85rem;
    transition: all 0.3s ease;
    box-shadow: 0 3px 8px rgba(0,0,0,0.2);
}

.product-overlay .btn-white:hover {
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    color: #fff;
    transform: translateY(-2px);
}

/* Card Body */
.card-body {
    padding: 1rem;
}

/* Title */
.product-title {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 0.4rem;
    color: #333;
    line-height: 1.4;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2; /* max 2 lines */
    -webkit-box-orient: vertical;
}

/* Price badge (compact pill) */
.product-price {
    font-size: 1rem;
    font-weight: 600;
    color: #2575fc;
}


</style>

<!-- Font Awesome for icons -->
<!-- Font Awesome Free CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
@endpush