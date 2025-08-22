<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|unique:categories,name|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only('name');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        Category::create($data);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    // 🔹 Edit page
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // 🔹 Update category
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'  => 'required|unique:categories,name,'.$category->id.'|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only('name');

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($category->image && file_exists(storage_path('app/public/'.$category->image))) {
                unlink(storage_path('app/public/'.$category->image));
            }
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($data);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    // 🔹 Delete category
    public function destroy(Category $category)
    {
        // Delete image if exists
        if ($category->image && file_exists(storage_path('app/public/'.$category->image))) {
            unlink(storage_path('app/public/'.$category->image));
        }

        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
