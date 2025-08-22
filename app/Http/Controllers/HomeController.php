<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\Offer;
use App\Models\Page;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    // 🔹 Home Page
    public function home()
    {
        // Fetch dynamic home page content if needed
        $home = Page::where('slug', 'home')->first();

        // Active banners
        $banners = Banner::where('status', true)->get();

        // Fetch categories and latest products
        $categories = Category::all();
        $products   = Product::latest()->take(8)->get(); 

        return view('public.home', compact('home', 'banners', 'categories', 'products'));
    }

    // 🔹 Dynamic Pages (About, Contact, etc.)
    public function page(string $slug)
    {
        $page = Page::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('public.page', compact('page'));
    }

    // 🔹 Products
    public function products()
    {
        $products = Product::latest()->get();
        return view('public.products', compact('products'));
    }

    public function productDetail($id)
    {
        $product = Product::findOrFail($id);
        return view('public.product-detail', compact('product'));
    }

    // 🔹 Categories
    public function categories()
    {
        $categories = Category::all();
        return view('public.categories', compact('categories'));
    }

    // public function categoryDetail($id)
    // {
    //     $category = Category::with('products')->findOrFail($id);
    // $products = $category->products;
    // return view('public.category-detail', compact('category', 'products'));
    // }
    // 🔹 Offers
    public function offers()
    {
        $offers = Offer::all();
        return view('public.offers', compact('offers'));
    }

    // 🔹 Contact Page & Form
    public function contact()
    {
        return view('public.contact');
    }

    public function sendContact(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|max:255',
            'message'=>'required|string',
        ]);

        // Send email
        Mail::raw($data['message'], function($message) use ($data){
            $message->to('info@mymakeup.com')
                    ->subject('Contact Form: '.$data['name'])
                    ->from($data['email'], $data['name']);
        });

        return back()->with('success','Your message has been sent successfully!');
    }
}
