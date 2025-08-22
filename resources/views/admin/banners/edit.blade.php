@extends('layouts.app')

@section('title', 'Edit Banner')

@section('content')
<div class="container py-5">
  <h2 class="mb-4">Edit Banner</h2>

  <form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label class="form-label">Title</label>
      <input type="text" name="title" value="{{ old('title', $banner->title) }}" class="form-control">
    </div>

    <div class="mb-3">
      <label class="form-label">Current Image</label><br>
      <img src="{{ asset('storage/'.$banner->image) }}" width="240" class="rounded mb-2">
    </div>

    <div class="mb-3">
      <label class="form-label">Replace Image</label>
      <input type="file" name="image" class="form-control">
    </div>

    <div class="mb-3">
      <label class="form-label">Link (optional)</label>
      <input type="url" name="link" value="{{ old('link', $banner->link) }}" class="form-control">
    </div>

    <div class="form-check mb-3">
      <input class="form-check-input" type="checkbox" value="1" name="status" id="status" {{ $banner->status ? 'checked' : '' }}>
      <label class="form-check-label" for="status">Active</label>
    </div>

    <button class="btn btn-primary">Save</button>
    <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Cancel</a>
  </form>
</div>
@endsection
