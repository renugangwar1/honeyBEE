@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4 text-center">Your Wishlist</h2>

    @if(count($wishlist) > 0)
        <div class="row g-4" id="wishlist-container">
            @foreach($wishlist as $product_id => $v)
                @php
                    $product = \App\Models\Product::find($product_id);
                @endphp
                @if($product)
                <div class="col-12 col-md-6 col-lg-4 wishlist-item" data-id="{{ $product->id }}">
                    <div class="wishlist-card shadow-sm rounded-4 overflow-hidden h-100 d-flex flex-column">
                        
                        <!-- Image -->
                        <div class="wishlist-img-wrapper">
                            <img src="{{ asset('storage/'.$product->image) }}" 
                                 alt="{{ $product->name }}" 
                                 class="wishlist-img">
                            <div class="wishlist-overlay">
                                <span class="badge bg-primary rounded-pill">Wishlist</span>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-3 text-center d-flex flex-column flex-grow-1">
                            <h5 class="fw-semibold">{{ $product->name }}</h5>
                            <p class="text-gradient fw-bold mb-3">₹{{ number_format($product->price,2) }}</p>
                            
                            <div class="mt-auto d-flex justify-content-center gap-2 flex-wrap">
                                <button class="btn btn-gradient btn-sm add-to-cart" data-id="{{ $product->id }}">
                                    <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                                </button>
                                <button class="btn btn-danger btn-sm remove-wishlist" data-id="{{ $product->id }}">
                                    <i class="fas fa-trash me-2"></i>Remove
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    @else
        <div class="text-center mt-5">
            <p class="fs-5">Your wishlist is empty.</p>
            <a href="{{ url('/products') }}" class="btn btn-gradient btn-lg">Shop Products</a>
        </div>
    @endif
</div>
@endsection

@push('styles')
<style>
/* Card container */
.wishlist-card {
    background: #fff;
    border: none;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.wishlist-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 24px rgba(0,0,0,0.12);
}

/* Image wrapper */
.wishlist-img-wrapper {
    position: relative;
    width: 100%;
    height: 220px;
    overflow: hidden;
}
.wishlist-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .5s ease;
}
.wishlist-card:hover .wishlist-img {
    transform: scale(1.05);
}

/* Overlay */
.wishlist-overlay {
    position: absolute;
    top: 12px;
    left: 12px;
}

/* Gradient text */
.text-gradient {
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Gradient button */
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

/* Responsive */
@media(max-width:768px){
    .wishlist-img-wrapper { height: 180px; }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", () => {
    const csrf = '{{ csrf_token() }}';

    function updateCartCount(count){
        document.querySelectorAll('#cart-count').forEach(el => el.innerText = count);
    }
    function updateWishlistCount(count){
        document.querySelectorAll('#wishlist-count').forEach(el => el.innerText = count);
    }
    function showPopup(message, type = 'success') {
        const popup = document.getElementById('popup-message');
        if (!popup) return;
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
            headers: {'X-CSRF-TOKEN': csrf, 'Content-Type':'application/json'},
            body: JSON.stringify(payload)
        });
        let data = null;
        try { data = await res.json(); } catch (e) {}
        if (!res.ok) {
            throw new Error((data && (data.message || data.error)) || 'Something went wrong.');
        }
        return data;
    }

    // Remove from wishlist
    document.querySelectorAll('.remove-wishlist').forEach(btn => {
        btn.addEventListener('click', async function() {
            const id = this.dataset.id;
            try {
                const data = await postJSON("{{ route('wishlist.remove') }}", { product_id: id });
                showPopup(data.message || 'Removed from wishlist');
                updateWishlistCount(data.wishlist_count || 0);

                const item = document.querySelector(`.wishlist-item[data-id="${id}"]`);
                if (item) {
                    item.style.transition = "opacity .3s ease";
                    item.style.opacity = "0";
                    setTimeout(()=> item.remove(), 300);
                }

                if (document.querySelectorAll('.wishlist-item').length === 1) {
                    document.getElementById('wishlist-container').innerHTML =
                        `<div class="text-center mt-5">
                            <p class="fs-5">Your wishlist is empty.</p>
                            <a href="{{ url('/products') }}" class="btn btn-gradient btn-lg">Shop Products</a>
                        </div>`;
                }
            } catch (err) {
                showPopup(err.message, 'error');
            }
        });
    });

    // Add to Cart
    document.querySelectorAll('.add-to-cart').forEach(btn => {
        btn.addEventListener('click', async function() {
            const id = this.dataset.id;
            this.disabled = true;
            try {
                const data = await postJSON("{{ route('cart.add') }}", { product_id: id });
                showPopup(data.message || 'Product added to cart!');
                updateCartCount(data.cart_count || 0);
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
