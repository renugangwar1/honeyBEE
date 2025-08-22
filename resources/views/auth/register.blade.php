@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-dark text-white text-center">
                    <h4>📝 Register</h4>
                </div>
                <div class="card-body">
                  <form method="POST" action="{{ route('register.post') }}">
    @csrf

    {{-- Email --}}
    <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
            name="email" value="{{ old('email') }}" required>
        @error('email')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    {{-- Password --}}
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input id="password" type="password"
            class="form-control @error('password') is-invalid @enderror" name="password" required>
        @error('password')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="d-grid mb-2">
        <button type="submit" class="btn btn-dark">Register</button>
    </div>

    <p class="text-center small">
        Already have an account? 
        <a href="{{ route('login') }}" class="text-decoration-none">Login here</a>
    </p>
</form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
