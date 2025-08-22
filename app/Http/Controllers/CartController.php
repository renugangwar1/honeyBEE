<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Show cart items
    public function index()
    {
        $cart = session()->get('cart', []);
        $items = [];

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $items[] = [
                    'product'  => $product,
                    'quantity' => $quantity,
                    'subtotal' => $product->price * $quantity,
                ];
            }
        }

        $total = collect($items)->sum('subtotal');

        return view('public.cart.index', compact('items', 'total'));
    }

    // Add product to cart (AJAX)
    public function add(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['status' => 'guest'], 200);
        }

        $validated = $request->validate([
            'product_id' => ['required','integer','exists:products,id'],
            'qty'        => ['nullable','integer','min:1']
        ]);

        $product = Product::find($validated['product_id']);
        if (!$product) {
            return response()->json(['status' => 'error', 'message' => 'Product not found.'], 404);
        }

        if (isset($product->stock) && $product->stock <= 0) {
            return response()->json(['status' => 'error', 'message' => 'Out of stock.'], 422);
        }

        $qty = $validated['qty'] ?? 1;

        $cart = session()->get('cart', []);
        $cart[$product->id] = ($cart[$product->id] ?? 0) + $qty;
        session()->put('cart', $cart);

        return response()->json([
            'status'     => 'success',
            'message'    => 'Product added to cart!',
            'cart_count' => array_sum($cart)
        ]);
    }

    // Remove product from cart (AJAX)
    public function remove(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required','integer']
        ]);

        $cart = session()->get('cart', []);
        if (isset($cart[$validated['product_id']])) {
            unset($cart[$validated['product_id']]);
            session()->put('cart', $cart);
        }

        return response()->json([
            'message'    => 'Product removed from cart!',
            'cart_count' => array_sum($cart)
        ]);
    }
    // Update product quantity
public function update(Request $request)
{
    $productId = $request->input('product_id');
    $action = $request->input('action');
    $cart = session()->get('cart', []);

    if(isset($cart[$productId])){
        if($action === 'increase'){
            $cart[$productId]++;
        } elseif($action === 'decrease'){
            $cart[$productId]--;
            if ($cart[$productId] <= 0) {
                unset($cart[$productId]);
            }
        }

        session()->put('cart', $cart);

        // Recalculate totals
        $items = [];
        $total = 0;
        foreach($cart as $id => $qty){
            $product = Product::find($id);
            if($product){
                $subtotal = $product->price * $qty;
                $items[$id] = [
                    'quantity' => $qty,
                    'subtotal' => $subtotal,
                ];
                $total += $subtotal;
            }
        }

        return response()->json([
            'cart_count' => array_sum($cart),
            'quantity'   => $cart[$productId] ?? 0,
            'subtotal'   => $items[$productId]['subtotal'] ?? 0,
            'total'      => $total,
        ]);
    }

    return response()->json(['error' => 'Product not in cart.'], 400);
}



}
