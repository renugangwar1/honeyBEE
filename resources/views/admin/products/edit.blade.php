@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
<div class="container py-5">
    <h2>Edit Product</h2>
    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $product->description }}</textarea>
        </div>
        <div class="mb-3">
            <label>Price</label>
            <input type="number" step="0.01" name="price" class="form-control" value="{{ $product->price }}" required>
        </div>
        <div class="mb-3">
            <label>Image</label>
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" width="80" class="d-block mb-2">
            @endif
            <input type="file" name="image" class="form-control">
        </div>
        <select name="category_id" class="form-control" required>
    @foreach($categories as $cat)
        <option value="{{ $cat->id }}" @selected(old('category_id', $product->category_id) == $cat->id)>
            {{ $cat->name }}
        </option>
    @endforeach
</select>

<select name="subcategory_id" class="form-control">
    <option value="">-- Select Subcategory --</option>
    @foreach($subcategories as $sub)
        <option value="{{ $sub->id }}" @selected(old('subcategory_id', $product->subcategory_id) == $sub->id)>
            {{ $sub->name }}
        </option>
    @endforeach
</select>

        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
