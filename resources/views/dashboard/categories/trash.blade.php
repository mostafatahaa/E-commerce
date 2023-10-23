@extends('layouts.dashboard')

@section('title', 'Trashed Categories')



@section('breadcrumb')
@parent
<li class="breadcrumb-item active"><a href="#">Categories</a></li>
<li class="breadcrumb-item"><a>Trash</a></li>
@endsection




@section('content')

<div class="mb-5">
    <a href="{{ route('dashboard.categories.index') }}" class="btn btn-sm btn-outline-primary">Categories</a>
</div>

<x-alert type="success" />

<form action="{{URL::current()}}" method="get" class="d-flex justify-content-between mb-4">
    <x-form.input name="name" placeholder="Search for" class="mx-2" :value="request('name')" />
    <select name="status" class="form-control mx-2">
        <option value="">All</option>
        <option value="active" @selected(request('status')=='active' )>Active</option>
        <option value="archived" @selected(request('status')=='archived' )>Archived</option>
    </select>
    <button class="btn btn-dark">Filter</button>
</form>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>image</th>
            <th>Name</th>
            <th>Status</th>
            <th>Deleted At</th>
        </tr>
    </thead>


    <tbody>

        @forelse($categories as $category)
        <tr>
            <td>{{$category->id}}</td>
            <td><img src="{{ asset('storage/' . $category->image) }}" height="100" alt=""></td>
            <td>{{$category->name}}</td>
            <td>{{$category->status}}</td>
            <td>{{$category->deleted_at}}</td>

            <td>
                <form action="{{route('dashboard.categories.restore', $category->id)}}" method="post">
                    @csrf
                    <!-- Form Method Spoofing -->
                    @method('put')
                    <button type="submit" class="btn btn-sm btn-outline-primary">Restore</button>
                </form>
            </td>

            <td>
                <form action="{{route('dashboard.categories.force-delete', $category->id)}}" method="post">
                    @csrf
                    <!-- Form Method Spoofing -->
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
            </td>

        </tr>
        @empty
        <tr>
            <td colspan="6">No categories defined.</td>
        </tr>
        @endforelse

    </tbody>
</table>

{{$categories->withQueryString()->links()}}

@endsection