@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold text-center mb-5">{{ $category->name }}</h2>

    @if($products->count())
    <div class="row g-4">
        @foreach($products as $product)
        <div class="col-6 col-md-4 col-lg-3">
            <div class="product-card position-relative rounded-4 overflow-hidden shadow-lg">
                
                <!-- Product Image -->
                <div class="position-relative overflow-hidden">
                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="w-100 product-img">

                    <!-- Hover Overlay -->
                    <div class="product-overlay d-flex flex-column align-items-center justify-content-center">
                        <a href="{{ url('/products/'.$product->id) }}" class="btn btn-white btn-sm mb-2">
                            <i class="fas fa-eye"></i> View
                        </a>
                        <!-- <a href="#" class="btn btn-white btn-sm">
                            <i class="fas fa-shopping-cart"></i> Add to Cart
                        </a> -->
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body text-center py-3">
                    <h5 class="fw-semibold mb-1">{{ $product->name }}</h5>
                    <span class="badge bg-gradient-price">₹{{ $product->price }}</span>
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
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.product-card:hover {
    transform: translateY(-7px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.2);
}

/* Product image */
.product-img {
    width: 100%;
    height: 220px;
    object-fit: cover;
    transition: transform 0.5s ease;
}
.product-card:hover .product-img {
    transform: scale(1.1);
}

/* Hover overlay */
.product-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.5);
    opacity: 0;
    transition: opacity 0.3s ease;
    flex-direction: column;
}
.product-card:hover .product-overlay {
    opacity: 1;
}

/* Overlay buttons */
.product-overlay .btn-white {
    background-color: #fff;
    color: #333;
    font-weight: 600;
    border-radius: 50px;
    padding: 0.35rem 0.9rem;
    transition: transform 0.3s ease, background 0.3s ease;
}
.product-overlay .btn-white:hover {
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    color: #fff;
    transform: scale(1.05);
}

/* Price badge */
.badge.bg-gradient-price {
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    color: #fff;
    font-size: 0.9rem;
    padding: 0.35rem 0.7rem;
    border-radius: 50px;
    display: inline-block;
}

/* Card body text */
.card-body h5 {
    font-size: 1rem;
    margin-bottom: 0.5rem;
}
</style>

<!-- Font Awesome for icons -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endpush
