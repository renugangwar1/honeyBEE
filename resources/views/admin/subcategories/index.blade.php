@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>Manage Subcategories</h2>
    <a href="{{ route('admin.subcategories.create') }}" class="btn btn-primary mb-3">Add Subcategory</a>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Subcategory</th>
            <th>Category</th>
        </tr>
        @foreach($subcategories as $sub)
        <tr>
            <td>{{ $sub->id }}</td>
            <td>{{ $sub->name }}</td>
            <td>{{ $sub->category->name }}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
