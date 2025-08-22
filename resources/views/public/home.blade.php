@extends('layouts.app')

@section('content')

@if($banners->count())
<div id="bannerCarousel" class="carousel slide mb-5" data-bs-ride="carousel" data-bs-interval="4000">
  <div class="carousel-inner rounded-5 shadow-lg overflow-hidden">
    @foreach($banners as $index => $banner)
      <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
        <a href="{{ $banner->link ?? '#' }}" class="d-block overflow-hidden">
          <img src="{{ asset('storage/'.$banner->image) }}" 
               class="d-block w-100 carousel-image" 
               alt="{{ $banner->title }}">
        </a>
        @if($banner->title)
        <div class="carousel-caption d-none d-md-block">
          <div class="caption-bg p-4 rounded-4">
            <h2 class="fw-bold text-white animate-caption">{{ $banner->title }}</h2>
          </div>
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
/* Smooth image zoom effect */
.carousel-image {
    height: 500px;
    object-fit: cover;
    transition: transform 0.6s ease;
}
.carousel-item.active .carousel-image {
    transform: scale(1.05);
}

/* Caption background with gradient */
.caption-bg {
    background: linear-gradient(135deg, rgba(0,0,0,0.6), rgba(0,0,0,0.3));
}

/* Caption animation */
.animate-caption {
    animation: slideUp 0.8s ease forwards;
    opacity: 0;
}

@keyframes slideUp {
    0% {
        transform: translateY(20px);
        opacity: 0;
    }
    100% {
        transform: translateY(0);
        opacity: 1;
    }
}

/* Carousel controls customization */
.carousel-control-prev-icon,
.carousel-control-next-icon {
    background-size: 50%, 50%;
    filter: brightness(1.2);
    transition: transform 0.3s ease;
}

.carousel-control-prev:hover .carousel-control-prev-icon,
.carousel-control-next:hover .carousel-control-next-icon {
    transform: scale(1.2);
}
</style>
@endpush
