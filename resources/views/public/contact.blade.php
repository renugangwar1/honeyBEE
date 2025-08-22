@extends('layouts.app')

@section('content')
<div class="container">
  <h2 class="fw-bold text-center mb-4">Contact Us</h2>
  <div class="row justify-content-center">
    <div class="col-md-6">
      <form action="{{ route('contact.send') }}" method="POST" class="p-4 shadow rounded-4">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="message" class="form-label">Message</label>
          <textarea name="message" id="message" rows="5" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-gradient w-100 fw-bold">Send Message</button>
      </form>
    </div>
  </div>
</div>
@endsection
