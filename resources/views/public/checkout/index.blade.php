@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4 text-center">Checkout</h2>

    @if(count($cart) > 0)

    <!-- Progress Steps -->
    <div class="checkout-steps d-flex justify-content-between mb-5">
        <div class="step active">Cart</div>
        <div class="step">Address</div>
        <div class="step">Payment</div>
        <div class="step">Placed</div>
    </div>

    <div id="checkout-forms">

        <!-- STEP 1: Cart Products -->
        <div class="step-content active" id="step-cart">
            <h4 class="mb-3">Your Products</h4>
            <div class="d-flex flex-column gap-3">
                @foreach($cart as $product_id => $qty)
                    @php $product = \App\Models\Product::find($product_id); @endphp
                    @if($product)
                    <div class="checkout-card d-flex justify-content-between align-items-center p-3">
                        <div class="d-flex gap-3 align-items-center">
                            <img src="{{ asset('storage/'.$product->image) }}" class="checkout-img">
                            <div>
                                <h6 class="fw-semibold mb-1">{{ $product->name }}</h6>
                                <small class="text-muted">Qty: {{ $qty }}</small>
                            </div>
                        </div>
                        <span class="fw-bold text-gradient">₹{{ $product->price * $qty }}</span>
                    </div>
                    @endif
                @endforeach
            </div>
            <div class="text-end mt-3">
                <h5>Total: <span class="text-gradient">
                    ₹{{ array_sum(array_map(fn($id,$q)=> \App\Models\Product::find($id)->price * $q, array_keys($cart), $cart)) }}
                </span></h5>
            </div>
            <div class="text-end mt-4">
                <button class="btn btn-gradient next-step">Next: Address</button>
            </div>
        </div>

        <!-- STEP 2: Billing Address -->
      <!-- STEP 2: Billing Address -->
<div class="step-content" id="step-address">
    <h4 class="mb-3">Billing & Shipping Details</h4>
    <form id="address-form">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phone" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Alternate Phone (Optional)</label>
                <input type="text" name="alt_phone" class="form-control">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Street Address</label>
            <input type="text" name="address_line1" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Apartment / Landmark (Optional)</label>
            <input type="text" name="address_line2" class="form-control">
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">City</label>
                <input type="text" name="city" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">State</label>
                <input type="text" name="state" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Postal Code</label>
                <input type="text" name="postal_code" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Country</label>
            <select name="country" class="form-select" required>
                <option value="">Select Country</option>
                <option value="India">India</option>
                <option value="USA">USA</option>
                <option value="UK">UK</option>
                <!-- Add more countries -->
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Order Notes (Optional)</label>
            <textarea name="order_notes" class="form-control" rows="3"></textarea>
        </div>
    </form>

    <div class="d-flex justify-content-between">
        <button class="btn btn-outline-secondary prev-step">Back</button>
        <button class="btn btn-gradient next-step">Next: Payment</button>
    </div>
</div>


        <!-- STEP 3: Payment -->
        <div class="step-content" id="step-payment">
            <h4 class="mb-3">Payment Method</h4>
            <div class="mb-3">
                <label><input type="radio" name="payment_method" value="cod" checked> Cash on Delivery</label><br>
                <label><input type="radio" name="payment_method" value="razorpay"> Razorpay</label><br>
                <label><input type="radio" name="payment_method" value="stripe"> Stripe</label>
            </div>
            <div class="d-flex justify-content-between">
                <button class="btn btn-outline-secondary prev-step">Back</button>
               <button type="button" class="btn btn-gradient" id="place-order">Place Order</button>

            </div>
        </div>

        <!-- STEP 4: Order Placed -->
        <div class="step-content" id="step-placed">
            <div class="text-center py-5">
                <h3 class="fw-bold text-gradient">🎉 Order Placed Successfully!</h3>
                <p class="mt-3">Thank you for shopping with us.</p>
                <a href="{{ route('products') }}" class="btn btn-gradient mt-3">Continue Shopping</a>
            </div>
        </div>

    </div>

    @else
        <div class="text-center mt-5">
            <p class="fs-5">Your cart is empty.</p>
            <a href="{{ url('/products') }}" class="btn btn-gradient btn-lg">Shop Products</a>
        </div>
    @endif
</div>
@endsection

@push('styles')
<style>
.checkout-steps .step {
    flex: 1; text-align: center; padding: 10px; border-bottom: 3px solid #ccc;
    font-weight: 600; color: #999; position: relative;
}
.checkout-steps .step.active {
    border-color: #6a11cb; color: #6a11cb;
}
.step-content { display: none; }
.step-content.active { display: block; }

.checkout-img { width:80px; height:80px; border-radius:12px; object-fit:cover; }
.text-gradient { background:linear-gradient(135deg,#6a11cb,#2575fc);
    -webkit-background-clip:text;-webkit-text-fill-color:transparent; }
.btn-gradient { background:linear-gradient(135deg,#6a11cb,#2575fc); color:#fff; border:none; }
.btn-gradient:hover { background:linear-gradient(135deg,#2575fc,#6a11cb); }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
    const steps = [...document.querySelectorAll('.step')];
    const contents = [...document.querySelectorAll('.step-content')];
    let current = 0;

    function showStep(index){
        steps.forEach((s,i)=> s.classList.toggle('active', i<=index));
        contents.forEach((c,i)=> c.classList.toggle('active', i===index));
        current = index;
    }

    document.querySelectorAll('.next-step').forEach(btn=>{
        btn.addEventListener('click', ()=>{
            if(current < contents.length-1){
                showStep(current+1);
            }
        });
    });

    document.querySelectorAll('.prev-step').forEach(btn=>{
        btn.addEventListener('click', ()=>{
            if(current > 0){
                showStep(current-1);
            }
        });
    });

    showStep(0); // start at Cart
});

document.addEventListener('DOMContentLoaded', function(){
    const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

   document.getElementById('place-order').addEventListener('click', async function(){
    const formData = {
        name: document.querySelector('[name="name"]').value,
        email: document.querySelector('[name="email"]').value,
        phone: document.querySelector('[name="phone"]').value,
        alt_phone: document.querySelector('[name="alt_phone"]').value,
        address_line1: document.querySelector('[name="address_line1"]').value,
        address_line2: document.querySelector('[name="address_line2"]').value,
        city: document.querySelector('[name="city"]').value,
        state: document.querySelector('[name="state"]').value,
        postal_code: document.querySelector('[name="postal_code"]').value,
        country: document.querySelector('[name="country"]').value,
        order_notes: document.querySelector('[name="order_notes"]').value,
        payment_method: document.querySelector('[name="payment_method"]:checked').value
    };

    try {
        const res = await fetch("{{ route('checkout.store') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrf
            },
            body: JSON.stringify(formData)
        });
        const data = await res.json();

        if (data.status === 'success') {
            // ✅ Show final step without reloading
            document.querySelectorAll('.step-content').forEach(c => c.classList.remove('active'));
            document.getElementById('step-placed').classList.add('active');

            document.querySelectorAll('.step').forEach(s => s.classList.remove('active'));
            document.querySelectorAll('.step')[3].classList.add('active');
        } else {
            alert(data.message || "Something went wrong");
        }
    } catch (err) {
        alert(err.message);
    }
});

});

</script>
@endpush
