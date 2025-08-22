@extends('layouts.app')

@section('content')

@if($banners->count())
<div id="bannerCarousel" class="carousel slide mb-5" data-bs-ride="carousel" data-bs-interval="4000">
  <div class="carousel-inner rounded-4 shadow-lg overflow-hidden">
    @foreach($banners as $index => $banner)
      <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
        <a href="{{ $banner->link ?? '#' }}" class="d-block overflow-hidden">
          <img src="{{ asset('storage/'.$banner->image) }}" 
               class="d-block w-100 carousel-image" 
               alt="{{ $banner->title }}">
        </a>
        @if($banner->title)
        <div class="carousel-caption d-none d-md-block">
          <div class="caption-bg p-3 px-4 rounded-3 shadow-lg">
            <h2 class="fw-bold text-white animate-caption">{{ $banner->title }}</h2>
          </div>
          <!-- <h2 class="fw-bold animate-caption" style="color: gold;">{{ $banner->title }}</h2> -->

        </div>
        @endif
      </div>
    @endforeach
  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon bg-dark rounded-circle p-2"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon bg-dark rounded-circle p-2"></span>
  </button>
</div>
@endif

@include('public.partials.featured-categories', ['categories' => $categories])
@include('public.partials.latest-products', ['products' => $products])
@include('public.partials.offer-banner')
@endsection

@push('styles')
<style>
/* ✅ Make banner responsive */
.carousel-image {
    width: 100%;
    height: 40vh; /* 60% of viewport height */
    min-height: 320px;
    max-height: 600px;
    object-fit: cover;
    transition: transform 0.8s ease;
}
.carousel-item.active .carousel-image {
    transform: scale(1.04); /* gentle zoom effect */
}

/* ✅ Caption improvements */
.caption-bg {
    background: rgba(0,0,0,0.55);
    backdrop-filter: blur(6px);
}
.animate-caption {
    animation: fadeInUp 1s ease forwards;
    opacity: 0;
}
@keyframes fadeInUp {
    from { transform: translateY(25px); opacity: 0; }
    to   { transform: translateY(0); opacity: 1; }
}

/* ✅ Carousel controls */
.carousel-control-prev-icon,
.carousel-control-next-icon {
    background-size: 60%;
    filter: invert(1) brightness(1.2);
    transition: transform 0.3s ease;
}
.carousel-control-prev:hover .carousel-control-prev-icon,
.carousel-control-next:hover .carousel-control-next-icon {
    transform: scale(1.2);
}
</style>
@endpush
