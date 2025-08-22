@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Products</h2>
    <a href="{{ route('admin.products.create') }}" class="btn btn-success mb-3">+ Add Product</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
       <thead>
    <tr>
        <th>#ID</th>
        <th>Name</th>
        <th>Category</th>
        <th>Subcategory</th>
        <th>Price</th>
        <th>Image</th>
        <th>Actions</th>
    </tr>
</thead>
<tbody>
    @foreach($products as $p)
    <tr>
        <td>{{ $p->id }}</td>
        <td>{{ $p->name }}</td>
        <td>{{ $p->category?->name }}</td>
        <td>{{ $p->subcategory?->name ?? '-' }}</td>
        <td>${{ $p->price }}</td>
        <td>
            @if($p->image)
                <img src="{{ asset('storage/'.$p->image) }}" width="60">
            @endif
        </td>
                <td>
                    <a href="{{ route('admin.products.edit', $p) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.products.destroy', $p) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm"
                            onclick="return confirm('Delete this product?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
