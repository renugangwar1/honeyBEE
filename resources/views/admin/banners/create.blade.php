@extends('layouts.app')

@section('title', 'Add Banner')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold text-dark">➕ Add New Banner</h2>

    <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Title --}}
        <div class="mb-3">
            <label class="form-label">Banner Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        {{-- Image Upload --}}
        <div class="mb-3">
            <label class="form-label">Banner Image</label>
            <input type="file" name="image" class="form-control" required>
        </div>

        {{-- Link URL --}}
        <div class="mb-3">
            <label class="form-label">Link (Optional)</label>
            <input type="url" name="link" class="form-control">
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn btn-primary">Save Banner</button>
        <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
