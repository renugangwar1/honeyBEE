<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ $title ?? 'MyMakeup' }}</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  @stack('styles')
</head>
<div id="popup-message" 
     class="position-fixed top-0 start-50 translate-middle-x mt-3 px-4 py-2 rounded shadow text-white fw-semibold d-none"
     style="z-index: 9999; background: linear-gradient(135deg,#6a11cb,#2575fc); transition: opacity .3s ease;">
</div>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold text-danger" href="{{ url('/') }}">💄 MyMakeup</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        {{-- Common Links --}}
        <li class="nav-item"><a class="nav-link fw-semibold" href="{{ url('/') }}"><i class="fa-solid fa-house"></i> Home</a></li>
        <li class="nav-item"><a class="nav-link fw-semibold" href="{{ url('/products') }}"><i class="fa-solid fa-box-open"></i> Products</a></li>
        <li class="nav-item"><a class="nav-link fw-semibold" href="{{ url('/categories') }}"><i class="fa-solid fa-list"></i> Categories</a></li>
        <li class="nav-item"><a class="nav-link fw-semibold" href="{{ url('/offers') }}"><i class="fa-solid fa-tags"></i> Offers</a></li>

        @auth
            @if(Auth::user()->role === 'admin')
                {{-- Admin Links --}}
                <li class="nav-item"><a class="nav-link fw-semibold" href="{{ url('/admin/dashboard') }}"><i class="fa-solid fa-gauge-high"></i> Admin Dashboard</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold" href="{{ url('/admin/users') }}"><i class="fa-solid fa-users"></i> Manage Users</a></li>
            @else
                {{-- Normal User Links --}}
                <li class="nav-item"><a class="nav-link fw-semibold" href="{{ url('/profile') }}"><i class="fa-solid fa-user"></i> Profile</a></li>
                <li class="nav-item position-relative">
                    <a class="nav-link fw-semibold" href="{{ url('/cart') }}">
                        <i class="fas fa-shopping-cart"></i> Cart
                        <span class="badge bg-danger position-absolute top-0 start-100 translate-middle p-1 rounded-circle" id="cart-count">0</span>
                    </a>
                </li>
                <li class="nav-item position-relative">
                    <a class="nav-link fw-semibold" href="{{ url('/wishlist') }}">
                        <i class="fas fa-heart"></i> Wishlist
                        <span class="badge bg-danger position-absolute top-0 start-100 translate-middle p-1 rounded-circle" id="wishlist-count">0</span>
                    </a>
                </li>
            @endif

            {{-- Logout Button --}}
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link fw-semibold">
                        <i class="fa-solid fa-right-from-bracket"></i> Logout
                    </button>
                </form>
            </li>
        @else
            {{-- Guest Links --}}
            <li class="nav-item"><a class="btn btn-danger ms-2" href="{{ route('login') }}"><i class="fa-solid fa-right-to-bracket"></i> Login</a></li>
        @endauth
      </ul>
    </div>
  </div>
</nav>

<!-- Main Content -->
<div class="container py-5">
  @yield('content')
</div>

<!-- Footer -->
<footer class="bg-dark text-white py-5 mt-5">
  <div class="container">
    <div class="row">
      <div class="col-md-4 mb-3">
        <h5 class="fw-bold">About</h5>
        <p class="small">MyMakeup is your one-stop destination for premium beauty and cosmetics. Explore top brands, latest trends, and exclusive offers.</p>
      </div>
      <div class="col-md-4 mb-3">
        <h5 class="fw-bold">Quick Links</h5>
        <ul class="list-unstyled">
          <li><a href="{{ url('/about') }}" class="text-white text-decoration-none"><i class="fa-solid fa-circle-info"></i> About Us</a></li>
          <li><a href="{{ url('/contact') }}" class="text-white text-decoration-none"><i class="fa-solid fa-envelope"></i> Contact</a></li>
          <li><a href="{{ url('/offers') }}" class="text-white text-decoration-none"><i class="fa-solid fa-tags"></i> Offers</a></li>
        </ul>
      </div>
      <div class="col-md-4 mb-3">
        <h5 class="fw-bold">Follow Us</h5>
        <a href="#" class="text-white me-3"><i class="fab fa-facebook fa-lg"></i></a>
        <a href="#" class="text-white me-3"><i class="fab fa-instagram fa-lg"></i></a>
        <a href="#" class="text-white"><i class="fab fa-twitter fa-lg"></i></a>
      </div>
    </div>
    <hr class="border-secondary">
    <p class="text-center small mb-0">© 2025 MyMakeup. All Rights Reserved.</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>

<style>
.navbar .badge {
    font-size: 0.65rem;
    padding: 0.25em 0.4em;
}
.btn-gradient {
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    color: #fff;
    transition: all 0.3s;
}
.btn-gradient:hover {
    background: linear-gradient(135deg, #2575fc, #6a11cb);
    transform: scale(1.05);
}
</style>
