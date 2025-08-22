@extends('layouts.app')

@section('title', 'User Dashboard')

@section('content')
<div class="container py-5">
    <h1>Welcome, {{ Auth::user()->name }}</h1>
    <p>This is your dashboard.</p>
</div>
@endsection
