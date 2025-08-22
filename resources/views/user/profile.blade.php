@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Welcome, {{ $user->name }}</h1>

    <!-- User Details -->
    <div class="card mb-4">
        <div class="card-header fw-bold">User Details</div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Phone:</strong> {{ $user->phone ?? 'N/A' }}</p>
            <p><strong>Address:</strong> {{ $user->address ?? 'N/A' }}</p>
        </div>
    </div>

    <!-- Orders -->
    <div class="card">
        <div class="card-header fw-bold">Your Orders</div>
        <div class="card-body">
            @if($orders->count())
                @foreach($orders as $order)
                    <div class="mb-4 border-bottom pb-3">
                        <h5>Order #{{ $order->id }} - 
                            <span class="text-muted">{{ $order->created_at->format('d M Y') }}</span>
                        </h5>
                        <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                        <p><strong>Total:</strong> ₹{{ number_format($order->total, 2) }}</p>

                        <ul class="list-group">
                            @foreach($order->orderItems as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        {{ $item->product->name }}
                                        <small class="text-muted">x {{ $item->quantity }}</small>
                                    </div>
                                    <span>₹{{ number_format($item->price * $item->quantity, 2) }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            @else
                <p>You have no orders yet.</p>
            @endif
        </div>
    </div>
</div>
@endsection
