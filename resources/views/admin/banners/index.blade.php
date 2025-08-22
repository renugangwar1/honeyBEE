@extends('layouts.app')

@section('title', 'Manage Banners')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold text-dark">🎨 Manage Banners</h2>

    <a href="{{ route('admin.banners.create') }}" class="btn btn-primary mb-3">+ Add Banner</a>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Link</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($banners as $banner)
                    <tr>
                        <td>{{ $banner->id }}</td>
                      <td>
    <img src="{{ asset('storage/'.$banner->image) }}" width="120" class="rounded">
</td>

                        <td>{{ $banner->title }}</td>
                        <td>{{ $banner->link ?? 'N/A' }}</td>
                        <td>
                            @if($banner->status)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.banners.edit', $banner->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" class="d-inline">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No banners found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
