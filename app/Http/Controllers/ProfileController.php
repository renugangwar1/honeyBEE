<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // If you track orders, eager-load them (adjust relations to your app)
        $orders = $user->orders()
            ->with('orderItems.product')
            ->latest()
            ->get();

        return view('user.profile', compact('user', 'orders'));
    }
}
