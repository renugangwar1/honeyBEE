<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function productDetail($id)
    {
        $product = Product::findOrFail($id); // get product by id
        return view('public.product-detail', compact('product'));
    }
}
