<div class="container mb-5">
  <div class="offer-banner position-relative p-5 rounded-5 shadow-lg text-center text-white overflow-hidden">
    <!-- Gradient Background -->
    <div class="offer-background position-absolute top-0 start-0 w-100 h-100"></div>

    <h2 class="fw-bold mb-3 offer-title">Special Offer: Free Shipping on Orders Above ₹999</h2>
    <p class="mb-4 fs-5 offer-text">Don’t miss out on this limited-time offer!</p>
    <a href="{{ url('/offers') }}" class="btn btn-light btn-lg fw-bold shadow-sm offer-btn">
      Shop Offers
    </a>
  </div>
</div>

<style>
/* Banner Styling */
.offer-banner {
    position: relative;
    z-index: 1;
    color: #fff;
    overflow: hidden;
    transition: transform 0.3s ease;
}
.offer-banner:hover {
    transform: translateY(-5px);
}

/* Gradient Background */
.offer-background {
    background: linear-gradient(135deg, #ff416c, #ff4b2b);
    filter: brightness(1.1);
    z-index: -1;
    transition: transform 0.5s ease;
}
.offer-banner:hover .offer-background {
    transform: scale(1.1) rotate(2deg);
}

/* Text Effects */
.offer-title {
    font-size: 2rem;
    text-shadow: 1px 1px 6px rgba(0,0,0,0.4);
}
.offer-text {
    text-shadow: 1px 1px 4px rgba(0,0,0,0.3);
}

/* Button Styling */
.offer-btn {
    transition: all 0.3s ease;
    border-radius: 50px;
}
.offer-btn:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 8px 20px rgba(0,0,0,0.3);
}
</style>
