<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function categoryDetail($id)
    {
        $category = Category::with('products')->findOrFail($id);
        $products = $category->products;

        return view('public.category-detail', compact('category', 'products'));
    }
}
