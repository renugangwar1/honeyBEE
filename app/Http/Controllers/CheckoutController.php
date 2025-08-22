<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    // Buy Now functionality
   public function buyNow(Request $request){
    if(!auth()->check()){
        return response()->json(['status'=>'guest']);
    }

    $cart = session()->get('cart', []);
    $cart[$request->product_id] = ($cart[$request->product_id] ?? 0) + 1;
    session()->put('cart', $cart);

    return response()->json([
        'status'=>'success',
        'checkout_url'=>route('checkout.index')
    ]);
}


    // Display checkout page
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('public.checkout.index', compact('cart'));
    }



    public function store(Request $request)
{
    $cart = session()->get('cart', []);

    if (empty($cart)) {
        return redirect()->route('checkout.index')->with('error', 'Your cart is empty!');
    }

    // Example: Save order to database
    // $order = Order::create([
    //     'user_id' => auth()->id(),
    //     'items' => json_encode($cart),
    //     'total' => $this->calculateTotal($cart),
    // ]);

    // Clear cart
    session()->forget('cart');

    return redirect()->route('checkout.index')->with('success', 'Order placed successfully!');
}

}
