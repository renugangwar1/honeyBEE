@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold text-dark">📦 Order #{{ $order->id }}</h2>

    <div class="card mb-4">
        <div class="card-body">
            <h5>User Info</h5>
            <p><strong>Name:</strong> {{ $order->user->name }}</p>
            <p><strong>Email:</strong> {{ $order->user->email }}</p>
            <p><strong>Shipping Address:</strong> {{ $order->shipping_address }}</p>
        </div>
    </div>

    <h5>Order Items</h5>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderItems as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->price, 2) }}</td>
                    <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h5 class="mt-3">Total: ${{ number_format($order->total, 2) }}</h5>

    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="mt-3">
        @csrf
        @method('PUT')
       <label for="status">Update Status:</label>
    <select name="status" class="form-select w-auto d-inline-block">
        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>shipped</option>
        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            
    </select>
    <button type="submit" class="btn btn-success btn-sm">Update</button>
    </form>
</div>
@endsection
