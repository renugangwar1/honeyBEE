@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4 text-center">Your Cart</h2>

    @if(count($items) > 0)
        <div class="table-responsive shadow-sm rounded-4 overflow-hidden">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Product</th>
                        <th>Price (₹)</th>
                        <th>Qty</th>
                        <th>Subtotal (₹)</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $row)
                        <tr data-id="{{ $row['product']->id }}">
                            <td class="d-flex align-items-center gap-3">
                                <img src="{{ asset('storage/'.$row['product']->image) }}" alt="" style="width:64px;height:64px;object-fit:cover;border-radius:8px;">
                                <div>
                                    <div class="fw-semibold">{{ $row['product']->name }}</div>
                                    <div class="text-muted small">SKU: {{ $row['product']->sku ?? 'N/A' }}</div>
                                </div>
                            </td>
                            <td>{{ number_format($row['product']->price, 2) }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-sm btn-outline-secondary qty-decrease">-</button>
                                    <input type="text" class="form-control text-center mx-2 qty-input" 
                                        style="width:60px;" value="{{ $row['quantity'] }}" readonly>
                                    <button class="btn btn-sm btn-outline-secondary qty-increase">+</button>
                                </div>
                            </td>
                            <td class="subtotal">₹{{ number_format($row['subtotal'], 2) }}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-danger remove-item">
                                    Remove
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" class="text-end fw-bold">Total</td>
                        <td class="fw-bold" id="cart-total">₹{{ number_format($total, 2) }}</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('products') }}" class="btn btn-outline-secondary">Continue Shopping</a>
            <a href="{{ route('checkout.index') }}" class="btn btn-gradient">Proceed to Checkout</a>
        </div>
    @else
        <div class="text-center mt-5">
            <p class="fs-5">Your cart is empty.</p>
            <a href="{{ route('products') }}" class="btn btn-gradient btn-lg">Shop Products</a>
        </div>
    @endif
</div>
@endsection

@push('styles')
<style>
.btn-gradient{
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    color:#fff; border:none;
}
.btn-gradient:hover{ opacity:.95 }
.qty-input { font-weight: 600; }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
    const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Remove item
    document.querySelectorAll('.remove-item').forEach(btn => {
        btn.addEventListener('click', async function(){
            const id = this.closest('tr').dataset.id;
            try{
                await fetch('{{ route("cart.remove") }}', {
                    method: 'POST',
                    headers: {'Content-Type':'application/json','X-CSRF-TOKEN': csrf},
                    body: JSON.stringify({product_id: id})
                });
                location.reload();
            }catch(e){
                alert('Could not remove item.');
            }
        });
    });

    // Increase quantity
   // Increase quantity
document.querySelectorAll('.qty-increase').forEach(btn => {
    btn.addEventListener('click', async function(){
        const row = this.closest('tr');
        const id = row.dataset.id;
        try{
            const res = await fetch('{{ route("cart.update") }}', {
                method: 'POST',
                headers: {'Content-Type':'application/json','X-CSRF-TOKEN': csrf},
                body: JSON.stringify({product_id: id, action: "increase"})
            });
            const data = await res.json();
            row.querySelector('.qty-input').value = data.quantity;
            row.querySelector('.subtotal').innerText = "₹" + data.subtotal.toFixed(2);
            document.querySelector('#cart-total').innerText = "₹" + data.total.toFixed(2);
            document.querySelectorAll('#cart-count').forEach(el => el.innerText = data.cart_count);
        }catch(e){ alert('Could not update quantity.'); }
    });
});

// Decrease quantity
document.querySelectorAll('.qty-decrease').forEach(btn => {
    btn.addEventListener('click', async function(){
        const row = this.closest('tr');
        const id = row.dataset.id;
        try{
            const res = await fetch('{{ route("cart.update") }}', {
                method: 'POST',
                headers: {'Content-Type':'application/json','X-CSRF-TOKEN': csrf},
                body: JSON.stringify({product_id: id, action: "decrease"})
            });
            const data = await res.json();

            if(data.quantity > 0){
                row.querySelector('.qty-input').value = data.quantity;
                row.querySelector('.subtotal').innerText = "₹" + data.subtotal.toFixed(2);
            } else {
                row.remove(); // remove row if product deleted
            }

            document.querySelector('#cart-total').innerText = "₹" + data.total.toFixed(2);
            document.querySelectorAll('#cart-count').forEach(el => el.innerText = data.cart_count);

        }catch(e){ alert('Could not update quantity.'); }
    });
});

});

</script>
@endpush
