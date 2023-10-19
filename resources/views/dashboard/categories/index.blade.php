@extends('layouts.dashboard')

@section('title', 'Categories')



@section('breadcrumb')
@parent

<li class="breedcrumb-item active">Categories Page</li>

@endsection




@section('content')

<div class="mb-5">
    <a href="{{ route('dashboard.categories.create') }}" class="btn btn-sm btn-outline-primary">New Category</a>
</div>

@if(session()->has('success'))

<div class="alert alert-success">
    {{session('success')}}
</div>

@endif

@if(session()->has('info'))

<div class="alert alert-info">
    {{session('info')}}
</div>

@endif

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>image</th>
            <th>Name</th>
            <th>Parent</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
    </thead>


    <tbody>

        @forelse($categories as $category)
        <tr>
            <td>{{$category->id}}</td>
            <td><img src="{{ asset('storage/' . $category->image) }}" height="100" alt=""></td>
            <td>{{$category->name}}</td>
            <td>{{$category->parent_id}}</td>
            <td>{{$category->created_at}}</td>
            <td>
                <a href="{{route('dashboard.categories.edit', $category->id)}}" class="btn btn-sm btn-outline-success">Edit</a>
            </td>

            <td>
                <form action="{{route('dashboard.categories.destroy', $category->id)}}" method="post">
                    @csrf
                    <!-- Form Method Spoofing -->
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
            </td>

        </tr>
        @empty
        <tr>
            <td colspan="7">No categories defined.</td>
        </tr>
        @endforelse

    </tbody>
</table>

@endsection