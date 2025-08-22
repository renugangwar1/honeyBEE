<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    // Buy Now functionality
    public function buyNow(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['status' => 'guest']);
        }

        $cart = session()->get('cart', []);
        $cart[$request->product_id] = ($cart[$request->product_id] ?? 0) + 1;
        session()->put('cart', $cart);

        return response()->json([
            'status' => 'success',
            'checkout_url' => route('checkout.index')
        ]);
    }

    // Display checkout page
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('public.checkout.index', compact('cart'));
    }

    // Store order
    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (!$cart || count($cart) === 0) {
            return response()->json(['status' => 'error', 'message' => 'Cart is empty.'], 400);
        }

        $data = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email',
            'phone'         => 'required|string|max:20',
            'alt_phone'     => 'nullable|string|max:20',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city'          => 'required|string|max:100',
            'state'         => 'required|string|max:100',
            'postal_code'   => 'required|string|max:20',
            'country'       => 'required|string|max:100',
            'order_notes'   => 'nullable|string',
            'payment_method'=> 'required|string|in:cod,razorpay,stripe',
        ]);

        $user = Auth::user();

        // Calculate total
        $total = 0;
        foreach ($cart as $product_id => $qty) {
            $product = Product::find($product_id);
            if ($product) {
                $total += $product->price * $qty;
            }
        }

        // Build full shipping address
        $shipping_address = $data['address_line1']
            . ($data['address_line2'] ? ', ' . $data['address_line2'] : '')
            . ', ' . $data['city']
            . ', ' . $data['state']
            . ' - ' . $data['postal_code']
            . ', ' . $data['country'];

        // Create order
        $order = Order::create([
            'user_id'        => $user->id,
            'total'          => $total,
            'status'         => 'pending',
            'payment_method' => $data['payment_method'],
            'shipping_address' => $shipping_address,
        ]);

        // Create order items
        foreach ($cart as $product_id => $qty) {
            $product = Product::find($product_id);
            if ($product) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $product->id,
                    'quantity'   => $qty,
                    'price'      => $product->price,
                ]);
            }
        }

        // Clear cart
        session()->forget('cart');

        return response()->json([
            'status'   => 'success',
            'message'  => 'Order placed successfully!',
            'order_id' => $order->id,
            'redirect' => route('checkout.index') . '#step-placed'
        ]);
    }
}
