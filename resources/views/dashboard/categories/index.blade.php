@extends('layouts.dashboard')

@section('title', 'Categories')



@section('breadcrumb')
@parent

<li class="breedcrumb-item active">Categories Page</li>

@endsection




@section('content')

<div class="mb-5">
    <a href="{{ route('categories.create') }}" class="btn btn-sm btn-outline-primary">New Category</a>
</div>

@if(session()->has('success'))

<div class="alert alert-success">
    {{session('success')}}
</div>

@endif

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
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
            <td>{{$category->name}}</td>
            <td>{{$category->parent_id}}</td>
            <td>{{$category->created_at}}</td>
            <td>
                <a href="{{route('categories.edit', $category->id)}}" class="btn btn-sm btn-outline-success">Edit</a>
            </td>

            <td>
                <form action="" method="post">
                    @csrf
                    <!-- Form Method Spoofing -->
                    @method('delete')
                    <a href="{{route('categories.destroy',  $category->id)}}" class="btn btn-sm btn-outline-danger">Delete</a>
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