<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ $title ?? 'Pink Petal' }}</title>

  @vite(['resources/css/app.css','resources/js/app.js'])

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- Premium Brand Font -->
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Parisienne&display=swap" rel="stylesheet">
  @stack('styles')
</head>

<div id="popup-message"
     class="position-fixed top-0 start-50 translate-middle-x mt-3 px-4 py-2 rounded shadow text-white fw-semibold d-none"
     style="z-index: 9999; background: linear-gradient(135deg,#6a11cb,#2575fc); transition: opacity .3s ease;">
</div>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg shadow-sm sticky-top"
     style="background: linear-gradient(90deg, #f9a8d4, #fbcfe8, #e9d5ff); border-bottom: 2px solid #f472b6;">

  <div class="container">

    <!-- Logo -->
<a class="navbar-brand d-flex align-items-center text-decoration-none"
   href="{{ url('/') }}">

    <i class="fa-solid fa-crown brand-crown me-2"></i>

    <span class="brand-logo">
        Pink Petal
    </span>

</a>
    <!-- Toggler -->
    <button class="navbar-toggler border-0"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav">

      <span class="navbar-toggler-icon"></span>

    </button>

    <!-- Links -->
    <div class="collapse navbar-collapse" id="navbarNav">

      <ul class="navbar-nav ms-auto align-items-center">

        <li class="nav-item mx-1">
          <a class="nav-link fw-semibold text-dark px-3 py-2 rounded hover-bg-light"
             href="{{ url('/') }}">
            <i class="fa-solid fa-house"></i> Home
          </a>
        </li>

        <li class="nav-item mx-1">
          <a class="nav-link fw-semibold text-dark px-3 py-2 rounded hover-bg-light"
             href="{{ url('/products') }}">
            <i class="fa-solid fa-box-open"></i> Products
          </a>
        </li>

        <li class="nav-item mx-1">
          <a class="nav-link fw-semibold text-dark px-3 py-2 rounded hover-bg-light"
             href="{{ url('/categories') }}">
            <i class="fa-solid fa-list"></i> Categories
          </a>
        </li>

        <li class="nav-item mx-1">
          <a class="nav-link fw-semibold text-dark px-3 py-2 rounded hover-bg-light"
             href="{{ url('/offers') }}">
            <i class="fa-solid fa-tags"></i> Offers
          </a>
        </li>

        {{-- Auth Check --}}
        @auth

            @if(Auth::user()->role === 'admin')

                <li class="nav-item mx-1">
                  <a class="nav-link fw-semibold text-dark px-3 py-2 rounded hover-bg-light"
                     href="{{ url('/admin/dashboard') }}">
                    <i class="fa-solid fa-gauge-high"></i> Dashboard
                  </a>
                </li>

            @else

                <li class="nav-item mx-1">
                  <a class="nav-link fw-semibold text-dark px-3 py-2 rounded hover-bg-light"
                     href="{{ url('/profile') }}">
                    <i class="fa-solid fa-user"></i> Profile
                  </a>
                </li>

                <li class="nav-item position-relative mx-1">
                  <a class="nav-link fw-semibold text-dark px-3 py-2 rounded hover-bg-light"
                     href="{{ url('/cart') }}">

                    <i class="fas fa-shopping-cart"></i> Cart

                    <span class="badge bg-danger text-white position-absolute top-0 start-100 translate-middle p-1 rounded-circle"
                          id="cart-count">
                        0
                    </span>

                  </a>
                </li>

            @endif

            <!-- Logout -->
            <li class="nav-item mx-1">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                            class="btn btn-dark fw-semibold px-3 py-2 rounded-pill">

                        <i class="fa-solid fa-right-from-bracket"></i>
                        Logout

                    </button>
                </form>
            </li>

        @else

            <li class="nav-item mx-1">
              <a class="btn btn-dark fw-semibold px-4 rounded-pill"
                 href="{{ route('login') }}">

                <i class="fa-solid fa-right-to-bracket"></i>
                Login

              </a>
            </li>

        @endauth

      </ul>

    </div>
  </div>
</nav>

<!-- Main Content -->
<!-- Main Content -->
<main class="flex-grow-1">
    <div class="container py-5">
        @yield('content')
    </div>
</main>
<!-- Footer -->
<footer class="bg-dark text-white py-5">

  <div class="container">

    <div class="row">

      <div class="col-md-4 mb-3">
        <h5 class="fw-bold">About</h5>

        <p class="small">
            Pink Petal is your one-stop destination for premium beauty and cosmetics.
            Explore top brands, latest trends, and exclusive offers.
        </p>
      </div>

      <div class="col-md-4 mb-3">
        <h5 class="fw-bold">Quick Links</h5>

        <ul class="list-unstyled">
          <li>
            <a href="{{ url('/about') }}" class="text-white text-decoration-none">
              <i class="fa-solid fa-circle-info"></i> About Us
            </a>
          </li>

          <li>
            <a href="{{ url('/contact') }}" class="text-white text-decoration-none">
              <i class="fa-solid fa-envelope"></i> Contact
            </a>
          </li>

          <li>
            <a href="{{ url('/offers') }}" class="text-white text-decoration-none">
              <i class="fa-solid fa-tags"></i> Offers
            </a>
          </li>
        </ul>
      </div>

      <div class="col-md-4 mb-3">
        <h5 class="fw-bold">Follow Us</h5>

        <a href="#" class="text-white me-3">
            <i class="fab fa-facebook fa-lg"></i>
        </a>

        <a href="#" class="text-white me-3">
            <i class="fab fa-instagram fa-lg"></i>
        </a>

        <a href="#" class="text-white">
            <i class="fab fa-twitter fa-lg"></i>
        </a>
      </div>

    </div>

    <hr class="border-secondary">

    <p class="text-center small mb-0">
        © 2026 Pink Petal. All Rights Reserved.
    </p>

  </div>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')

</body>
</html>

<style>
html,
body{
    height:100%;
}

body{
    min-height:100vh;
    display:flex;
    flex-direction:column;
}

.flex-grow-1{
    flex:1;
}

footer{
    margin-top:auto !important;
}

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

.hover-bg-light:hover {
    background-color: rgba(255, 255, 255, 0.5);
    transition: 0.3s;
}

.navbar-nav .nav-link {
    transition: all 0.3s ease;
    color: #4b5563 !important;
}

.navbar-nav .nav-link:hover {
    color: #1f2937 !important;
    transform: scale(1.05);
}

.navbar .badge {
    font-size: 0.6rem;
    min-width: 18px;
    min-height: 18px;
}


.brand-mark{
    width:42px;
    height:42px;
    border-radius:12px;
    background:linear-gradient(135deg,#f472b6,#ec4899);
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:700;
    font-size:14px;
    letter-spacing:1px;
    box-shadow:0 4px 10px rgba(236,72,153,.25);
}

.brand-logo{
    font-family:'Parisienne', cursive;
    font-size:2.4rem;
    color:#c2185b;
    line-height:1;
}

.brand-crown{
    color:#ec4899;
    font-size:24px;
}
</style>