<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishlistController extends Controller
{
    // Show wishlist page
    public function index()
    {
        $wishlist = session()->get('wishlist', []);
        return view('public.wishlist.index', compact('wishlist'));
    }

    // Add product to wishlist
    public function add(Request $request)
    {
        if(!auth()->check()){
            return response()->json(['status'=>'guest']);
        }

        $productId = $request->input('product_id');
        $wishlist = session()->get('wishlist', []);
        $wishlist[$productId] = true;
        session()->put('wishlist', $wishlist);

        return response()->json([
            'status'=>'success',
            'message'=>'Product added to wishlist!',
            'wishlist_count'=>count($wishlist)
        ]);
    }

    // Remove product from wishlist
    public function remove(Request $request)
    {
        $productId = $request->input('product_id');
        $wishlist = session()->get('wishlist', []);
        if(isset($wishlist[$productId])){
            unset($wishlist[$productId]);
            session()->put('wishlist', $wishlist);
        }

        return response()->json([
            'message' => 'Product removed from wishlist!',
            'wishlist_count'=>count($wishlist)
        ]);
    }
}
