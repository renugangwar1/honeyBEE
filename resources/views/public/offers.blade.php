@extends('layouts.app')

@section('content')
<h2 class="fw-bold text-center mb-4">Current Offers</h2>
<div class="row g-4">
  @foreach($offers as $offer)
  <div class="col-6 col-md-4">
    <div class="offer-card p-4 rounded-4 text-center position-relative overflow-hidden">
      <h5 class="fw-bold offer-title mb-2">{{ $offer->title }}</h5>
      <p class="offer-desc mb-3">{{ $offer->description }}</p>
      <a href="{{ url($offer->link) }}" class="btn offer-btn btn-sm">Shop Now</a>
    </div>
  </div>
  @endforeach
</div>
@endsection

<style>
/* Offer Card Styling */
.offer-card {
    background: linear-gradient(135deg, #ff758c, #ff7eb3);
    color: #fff;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}
.offer-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.2);
}

/* Text Styling */
.offer-title {
    font-size: 1.25rem;
    text-shadow: 1px 1px 5px rgba(0,0,0,0.3);
}
.offer-desc {
    font-size: 0.95rem;
    text-shadow: 1px 1px 3px rgba(0,0,0,0.2);
}

/* Button Styling */
.offer-btn {
    background-color: #fff;
    color: #ff4b2b;
    font-weight: 600;
    border-radius: 50px;
    transition: all 0.3s ease;
}
.offer-btn:hover {
    background-color: #ff4b2b;
    color: #fff;
    transform: translateY(-2px) scale(1.05);
    box-shadow: 0 6px 15px rgba(0,0,0,0.2);
}
</style>
