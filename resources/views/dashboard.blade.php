@extends('layouts.app')

@section('content')
<h2>User Dashboard</h2>
<p>Welcome, {{ auth()->user()->name }}! This is your dashboard after login.</p>
@endsection
