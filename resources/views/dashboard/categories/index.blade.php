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

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Parent</th>
            <th>Created At</th>
            <th colspan="2">Action</th>
        </tr>
    </thead>
</table>

<tbody>

    @forelse($categories as $category)
    <tr>
        <td>{{$category->name}}</td>
        <td>{{$category->id}}</td>
        <td>{{$category->parent_id}}</td>
        <td>{{$category->created_at}}</td>
        <td>
            <a href="{{route('categories.edit')}}" class="btn btn-sm btn-outline-success">Edit</a>
        </td>

        <td>
            <form action="" method="post">
                @csrf
                <!-- Form Method Spoofing -->
                @method('delete')
                <a href="{{route('categories.destroy')}}" class="btn btn-sm btn-outline-danger">Delete</a>
            </form>
        </td>

    </tr>
    @empty
    <tr>
        <td colspan="7">No categories defined.</td>
    </tr>
    @endforelse

</tbody>

@endsection