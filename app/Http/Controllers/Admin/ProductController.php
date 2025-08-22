<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory; // <-- add this
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Show all products in dashboard
    public function index()
    {
        // eager-load both relations
        $products = Product::with(['category','subcategory'])->get();
        return view('admin.products.index', compact('products'));
    }

    // Show add product form
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $subcategories = Subcategory::orderBy('name')->get(); // <-- pass this
        return view('admin.products.create', compact('categories','subcategories'));
    }

    // Store product
    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|max:255',
            'description'    => 'nullable|string',
            'price'          => 'required|numeric',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'category_id'    => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id', // <-- add this
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    // Show edit form
    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        $subcategories = Subcategory::orderBy('name')->get(); // <-- pass this too
        return view('admin.products.edit', compact('product', 'categories', 'subcategories'));
    }

    // Update product
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'           => 'required|max:255',
            'description'    => 'nullable|string',
            'price'          => 'required|numeric',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'category_id'    => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id', // <-- add this
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    // Delete product
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
