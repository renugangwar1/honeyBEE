@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Manage Categories</h2>
        <div>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary me-2">Add Category</a>
            <a href="{{ route('admin.subcategories.index') }}" class="btn btn-secondary">Manage Subcategories</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $cat)
                <tr>
                    <td>{{ $cat->id }}</td>
                    <td class="text-center">
                        @if($cat->image)
                        <img src="{{ asset('storage/'.$cat->image) }}" alt="{{ $cat->name }}" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                        @else
                        <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>{{ $cat->name }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.categories.edit', $cat->id) }}" class="btn btn-sm btn-warning me-1">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this category?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

<style>
.table-hover tbody tr:hover {
    background-color: #f1f5f9;
}
.btn-warning {
    color: #fff;
}
.btn-warning:hover {
    color: #fff;
}
.img-thumbnail {
    border-radius: 8px;
}
</style>
