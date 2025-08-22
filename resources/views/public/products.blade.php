@extends('layouts.app')

@section('content')
<h2 class="fw-bold text-center mb-4">All Products</h2>
<div class="row g-4">
  @foreach($products as $prod)
  <div class="col-6 col-md-3">
    <div class="product-card h-100 border-0 shadow-sm overflow-hidden rounded-4 position-relative">
      <div class="position-relative overflow-hidden">
        <img src="{{ asset('storage/'.$prod->image) }}" class="w-100 product-img" alt="{{ $prod->name }}">
        <div class="product-overlay d-flex align-items-center justify-content-center">
          <a href="{{ url('/products/'.$prod->id) }}" class="btn btn-outline-light btn-sm fw-semibold">View</a>
        </div>
      </div>
      <div class="card-body text-center">
        <h5 class="fw-semibold">{{ $prod->name }}</h5>
        <p class="text-danger fw-bold mb-2">₹{{ $prod->price }}</p>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endsection

@push('styles')
<style>
/* Card hover effect */
.product-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.2);
}

/* Image zoom on hover */
.product-img {
    transition: transform 0.5s ease;
}
.product-card:hover .product-img {
    transform: scale(1.1);
}

/* Overlay styling */
.product-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.4);
    opacity: 0;
    transition: opacity 0.4s ease;
}
.product-card:hover .product-overlay {
    opacity: 1;
}

/* Button styling inside overlay */
.product-overlay a {
    text-decoration: none;
    padding: 0.4rem 1rem;
    font-weight: 600;
    border-radius: 0.375rem;
    transition: background 0.3s ease, transform 0.3s ease;
}
.product-overlay a:hover {
    background: rgba(255,255,255,0.9);
    color: #000;
    transform: scale(1.05);
}



.product-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.2);
}

/* Image styling: fit inside card */
.product-img {
    width: 100%;
    height: 250px; /* fixed height for uniform cards */
    object-fit: cover; /* crop/fill nicely */
    transition: transform 0.5s ease;
}
.product-card:hover .product-img {
    transform: scale(1.1);
}

/* Overlay styling */
.product-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.4);
    opacity: 0;
    transition: opacity 0.4s ease;
}
.product-card:hover .product-overlay {
    opacity: 1;
}

/* Button styling inside overlay */
.product-overlay a {
    text-decoration: none;
    padding: 0.4rem 1rem;
    font-weight: 600;
    border-radius: 0.375rem;
    transition: background 0.3s ease, transform 0.3s ease;
}
.product-overlay a:hover {
    background: rgba(255,255,255,0.9);
    color: #000;
    transform: scale(1.05);
}

/* Card body text alignment */
.card-body {
    padding: 0.8rem 0.5rem;
}



</style>
@endpush
