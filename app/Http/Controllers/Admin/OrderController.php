<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // List all orders
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    // Show single order with items
    public function show($id)
    {
        $order = Order::with(['user', 'orderItems.product'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    // Update order status
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled,reached,shipped',
        ]);
        $order->status = $request->status;
        $order->save();

        return redirect()->route('admin.orders.index')->with('success', 'Order updated successfully.');
    }
}
