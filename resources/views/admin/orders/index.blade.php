@extends('layouts.app')

@section('title', 'Manage Orders')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">📦 Orders Management</h2>
        <span class="badge bg-secondary fs-6 px-3 py-2">
            Total Orders: {{ $orders->total() }}
        </span>
    </div>

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table align-middle table-hover">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th>Placed At</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr class="align-middle">
                                <td class="fw-semibold">#{{ $order->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-light text-dark d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px; font-size: 14px;">
                                            {{ strtoupper(substr($order->user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold">{{ $order->user->name }}</div>
                                            <small class="text-muted">{{ $order->user->email }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="fw-bold text-success">${{ number_format($order->total, 2) }}</td>
                                <td>
                                    @php
                                        $statusColors = [
                                            'pending' => 'warning',
                                            'completed' => 'success',
                                            'cancelled' => 'danger',
                                            'processing' => 'info',
                                             'shipped' => 'primary',
                                             'reached'=> 'primary'
                                        ];
                                    @endphp
                                    <span class="badge bg-{{ $statusColors[$order->status] ?? 'secondary' }} px-3 py-2">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border px-3 py-2">
                                        {{ strtoupper($order->payment_method) }}
                                    </span>
                                </td>
                                <td>{{ $order->created_at->format('d M Y • H:i') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.orders.show', $order->id) }}" 
                                       class="btn btn-sm btn-primary rounded-pill px-3 shadow-sm">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                    No orders found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{ $orders->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection
