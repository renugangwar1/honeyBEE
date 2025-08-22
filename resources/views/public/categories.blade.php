@extends('layouts.app')

@section('content')
<h2 class="fw-bold text-center mb-4">Categories</h2>
<div class="row g-4">
  @foreach($categories as $cat)
  <div class="col-6 col-md-3">
    <div class="category-card h-100 text-center position-relative overflow-hidden rounded-4 shadow-sm">
      <div class="position-relative overflow-hidden">
        <img src="{{ asset('storage/'.$cat->image) }}" class="w-100 category-img" alt="{{ $cat->name }}">
        <div class="category-overlay d-flex align-items-center justify-content-center">
          <a href="{{ url('/categories/'.$cat->id) }}" class="btn btn-gradient btn-sm fw-semibold">Explore</a>
        </div>
      </div>
      <div class="card-body pt-3">
        <h5 class="fw-semibold">{{ $cat->name }}</h5>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endsection

@push('styles')
<style>
/* Category card styling */
.category-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.category-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.15);
}

/* Image fit and hover zoom */
.category-img {
    width: 100%;
    height: 180px; /* fixed height for uniform cards */
    object-fit: cover;
    transition: transform 0.5s ease;
}
.category-card:hover .category-img {
    transform: scale(1.1);
}

/* Overlay effect on hover */
.category-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.3);
    opacity: 0;
    transition: opacity 0.4s ease;
}
.category-card:hover .category-overlay {
    opacity: 1;
}

/* Gradient button */
.btn-gradient {
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    color: #fff;
    border: none;
    transition: transform 0.3s ease, background 0.3s ease;
}
.btn-gradient:hover {
    background: linear-gradient(135deg, #2575fc, #6a11cb);
    transform: scale(1.05);
}

/* Card body */
.card-body {
    padding: 0.5rem 0;
}
</style>
@endpush
