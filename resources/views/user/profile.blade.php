@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Welcome, {{ $user->name }}</h1>

    <div class="row g-4">
        <!-- User Details -->
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-header fw-bold">Your Details</div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Phone:</strong> {{ $user->phone ?? 'N/A' }}</p>
                    <p><strong>Address:</strong> {{ $user->$orders->shipping_address ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Orders -->
        <div class="col-md-7">
            <div class="card shadow-sm">
                <div class="card-header fw-bold">Your Orders</div>
                <div class="card-body">
                    @if(!empty($orders) && $orders->count())
                        @foreach($orders as $order)
                            <div class="mb-4 pb-3 border-bottom">
                                <div class="d-flex justify-content-between mb-3">
                                    <div>
                                        <strong>Order #{{ $order->id }}</strong>
                                        <div class="text-muted small">{{ $order->created_at->format('d M Y') }}</div>
                                    </div>
                                    <div class="text-end">
                                        <div class="fw-bold mt-1">₹{{ number_format($order->total, 2) }}</div>
                                    </div>
                                </div>

                                <!-- Order Status Vertical Timeline -->
                                @php
                                    $statuses = ['pending','processing','shipped','reached','delivered','completed','cancelled'];
                                    $currentStatusIndex = array_search($order->status, $statuses);
                                @endphp

                                <div class="order-status-tracker">
                                    <ul class="list-unstyled m-0 p-0">
                                        @foreach($statuses as $index => $status)
                                            <li class="d-flex align-items-start mb-3">
                                                <div class="me-3 d-flex flex-column align-items-center">
                                                    <div class="status-circle {{ $index <= $currentStatusIndex ? 'bg-success' : 'bg-light' }}"></div>
                                                    @if(!$loop->last)
                                                        <div class="status-line {{ $index < $currentStatusIndex ? 'bg-success' : 'bg-light' }}"></div>
                                                    @endif
                                                </div>
                                                <div>
                                                    <div class="{{ $index <= $currentStatusIndex ? 'fw-bold text-success' : 'text-muted' }}">
                                                        {{ ucfirst($status) }}
                                                    </div>
                                                    @if($order->status == $status)
                                                        <small class="text-muted">Current Status</small>
                                                    @endif
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <!-- Order Items -->
                                <ul class="list-group mt-3">
                                    @foreach($order->orderItems as $item)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center gap-3">
                                                @if($item->product?->image)
                                                    <img src="{{ asset('storage/'.$item->product->image) }}"
                                                         alt=""
                                                         style="width:48px;height:48px;object-fit:cover;border-radius:8px;">
                                                @endif
                                                <div>
                                                    <div class="fw-semibold">{{ $item->product->name ?? 'Product' }}</div>
                                                    <small class="text-muted">Qty: {{ $item->quantity }}</small>
                                                </div>
                                            </div>
                                            <span>₹{{ number_format(($item->price ?? 0) * $item->quantity, 2) }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    @else
                        <p class="mb-0">You have no orders yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.order-status-tracker {
    margin: 10px 0;
}
.status-circle {
    width: 14px;
    height: 14px;
    border-radius: 50%;
    border: 2px solid #ccc;
}
.status-circle.bg-success {
    border-color: #198754;
}
.status-line {
    width: 2px;
    height: 24px;
    margin-top: 2px;
}
.bg-success {
    background-color: #198754 !important;
}
.bg-light {
    background-color: #e9ecef !important;
}
</style>
@endsection
