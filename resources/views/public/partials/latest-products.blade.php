<div class="container mb-5">
    <h2 class="fw-bold text-center mb-4">Latest Products</h2>
    <div class="row g-3">
        @foreach($products as $prod)
        <div class="col-6 col-sm-4 col-md-3">
            <div class="product-card border-0 shadow-sm rounded-4 overflow-hidden h-100 bg-white position-relative">
                <div class="position-relative overflow-hidden">
                    <img src="{{ asset('storage/'.$prod->image) }}" class="w-100 product-img" alt="{{ $prod->name }}" style="height:200px; object-fit:cover;">
                    <div class="product-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-25 opacity-0 hover-opacity-100 transition">
                        <a href="{{ url('/products/'.$prod->id) }}" class="btn btn-outline-light btn-sm fw-semibold">View</a>
                    </div>
                </div>
                <div class="card-body text-center p-3">
                    <h6 class="fw-semibold mb-1 text-truncate">{{ $prod->name }}</h6>
                    <p class="text-danger fw-bold mb-0">₹{{ $prod->price }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
.product-card {
    transition: transform 0.2s;
}
.product-card:hover {
    transform: translateY(-5px);
}
.product-overlay {
    transition: all 0.3s;
}
.product-card:hover .product-overlay {
    opacity: 1;
}
.product-img {
    transition: transform 0.3s;
}
.product-card:hover .product-img {
    transform: scale(1.05);
}
</style>
