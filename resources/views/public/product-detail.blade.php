@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row g-4">
        <!-- Product Image Gallery -->
        <div class="col-md-6">
            <div id="productCarousel" class="carousel slide mb-3" data-bs-ride="carousel">
                <div class="carousel-inner rounded-4 shadow-sm">
                    <div class="carousel-item active">
                        <img src="{{ asset('storage/'.$product->image) }}" class="d-block w-100 product-main-img"
                            alt="{{ $product->name }}">
                    </div>
                    @if($product->images)
                    @foreach($product->images as $img)
                    <div class="carousel-item">
                        <img src="{{ asset('storage/'.$img) }}" class="d-block w-100 product-main-img"
                            alt="{{ $product->name }}">
                    </div>
                    @endforeach
                    @endif
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#productCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>

        <!-- Product Details -->
        <div class="col-md-6">
            <h2 class="fw-bold mb-2">{{ $product->name }}</h2>
            <div class="d-flex align-items-center mb-3">
                <h4 class="text-gradient fw-bold me-3">₹{{ $product->price }}</h4>
                @if($product->stock > 0)
                <span class="badge bg-success">In Stock</span>
                @else
                <span class="badge bg-danger">Out of Stock</span>
                @endif
            </div>

            <p class="mb-3">{{ $product->short_description ?? 'No short description available.' }}</p>
            <div class="d-flex gap-2 mb-3 flex-wrap">
                <button class="btn btn-gradient btn-lg add-to-cart" data-id="{{ $product->id }}">
                    <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                </button>
                <button class="btn btn-outline-primary btn-lg wishlist" data-id="{{ $product->id }}">
                    <i class="fas fa-heart me-2"></i>Wishlist
                </button>
                <button class="btn btn-success btn-lg buy-now" data-id="{{ $product->id }}">
                    <i class="fas fa-bolt me-2"></i>Buy Now
                </button>
            </div>

            <ul class="list-unstyled small text-muted">
                <li>Category: <strong>{{ $product->category->name ?? 'Uncategorized' }}</strong></li>
                <li>SKU: <strong>{{ $product->sku ?? 'N/A' }}</strong></li>
                <li>Rating:
                    @for($i=1; $i<=5; $i++) <i
                        class="fas fa-star text-warning {{ $i <= $product->rating ? '' : 'text-secondary' }}"></i>
                        @endfor
                </li>
            </ul>
        </div>
    </div>

    <!-- Product Tabs -->
    <div class="mt-5">
        <ul class="nav nav-tabs" id="productTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="desc-tab" data-bs-toggle="tab" data-bs-target="#desc"
                    type="button">Description</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews"
                    type="button">Reviews</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="spec-tab" data-bs-toggle="tab" data-bs-target="#spec"
                    type="button">Specifications</button>
            </li>
        </ul>
        <div class="tab-content p-4 border rounded-bottom shadow-sm" id="productTabContent">
            <div class="tab-pane fade show active" id="desc" role="tabpanel">
                {!! $product->description ?? 'No description available.' !!}
            </div>
            <div class="tab-pane fade" id="reviews" role="tabpanel">
                <p>No reviews yet.</p>
            </div>
            <div class="tab-pane fade" id="spec" role="tabpanel">
                <p>No specifications available.</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.product-main-img {
    object-fit: cover;
    height: 450px;
    border-radius: 12px;
    transition: transform 0.5s ease;
}

.product-main-img:hover {
    transform: scale(1.05);
}

.btn-gradient {
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    color: #fff;
    border: none;
    transition: all 0.3s ease;
}

.btn-gradient:hover {
    background: linear-gradient(135deg, #2575fc, #6a11cb);
    transform: scale(1.05);
}

.text-gradient {
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Tabs styling */
.nav-tabs .nav-link {
    font-weight: 600;
    color: #555;
    transition: color 0.3s ease, background 0.3s ease;
}

.nav-tabs .nav-link.active {
    color: #fff;
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    border-radius: 6px 6px 0 0;
}

.tab-content {
    background: #fff;
}

/* Responsive adjustments */
@media(max-width:768px) {
    .product-main-img {
        height: 300px;
    }
}
</style>

@endpush
@push('scripts')
<script>

document.addEventListener('DOMContentLoaded', function () {
    const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    function updateCartCount(count){
        document.querySelectorAll('#cart-count').forEach(el => el.innerText = count);
    }
    function updateWishlistCount(count){
        document.querySelectorAll('#wishlist-count').forEach(el => el.innerText = count);
    }
    function checkLogin(data){
        if(data && data.status === 'guest'){
            showPopup('Please login to continue!', 'error');
            window.location.href = '{{ route("login") }}';
            return false;
        }
        return true;
    }

    // ✅ Reusable popup function
    function showPopup(message, type = 'success') {
        const popup = document.getElementById('popup-message');
        popup.innerText = message;
        popup.classList.remove('d-none');
        popup.style.opacity = "1";
        popup.style.background = (type === 'success')
            ? "linear-gradient(135deg,#6a11cb,#2575fc)"
            : "#dc3545"; // red for error

        setTimeout(() => {
            popup.style.opacity = "0";
            setTimeout(() => popup.classList.add('d-none'), 300);
        }, 3000);
    }

    async function postJSON(url, payload) {
        const res = await fetch(url, {
            method: 'POST',
            headers: {'Content-Type':'application/json', 'X-CSRF-TOKEN': csrf},
            body: JSON.stringify(payload)
        });
        let data = null;
        try { data = await res.json(); } catch (e) {}
        if (!res.ok) {
            const msg = (data && (data.message || data.error)) || 'Something went wrong.';
            throw new Error(msg);
        }
        return data;
    }

    // Add to Cart
    document.querySelectorAll('.add-to-cart').forEach(btn => {
        btn.addEventListener('click', async function() {
            const id = this.dataset.id;
            this.disabled = true;
            try {
                const data = await postJSON("{{ route('cart.add') }}", { product_id: id });
                if(!checkLogin(data)) return;
                showPopup(data.message || 'Added to cart!');
                updateCartCount(data.cart_count || 0);
            } catch (err) {
                showPopup(err.message, 'error');
            } finally {
                this.disabled = false;
            }
        });
    });

    // Wishlist
    document.querySelectorAll('.wishlist').forEach(btn => {
        btn.addEventListener('click', async function() {
            const id = this.dataset.id;
            this.disabled = true;
            try {
                const data = await postJSON("{{ route('wishlist.add') }}", { product_id: id });
                if(!checkLogin(data)) return;
                showPopup(data.message || 'Added to wishlist!');
                updateWishlistCount(data.wishlist_count || 0);
            } catch (err) {
                showPopup(err.message, 'error');
            } finally {
                this.disabled = false;
            }
        });
    });

    // Buy Now
    document.querySelectorAll('.buy-now').forEach(btn => {
        btn.addEventListener('click', async function() {
            const id = this.dataset.id;
            this.disabled = true;
            try {
                const data = await postJSON("{{ route('buy.now') }}", { product_id: id });
                if(!checkLogin(data)) return;
                if (data.checkout_url) {
                    window.location.href = data.checkout_url;
                } else {
                    showPopup('Checkout URL missing.', 'error');
                }
            } catch (err) {
                showPopup(err.message, 'error');
            } finally {
                this.disabled = false;
            }
        });
    });
});





</script>

@endpush