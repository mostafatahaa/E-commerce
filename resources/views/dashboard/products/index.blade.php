@extends('layouts.dashboard')

@section('title', 'Products')



@section('breadcrumb')
@parent

<li class="breadcrumb-item"><a>Products</a></li>

@endsection




@section('content')

<div class="mb-5">
    <a href="{{ route('dashboard.categories.create') }}" class="btn btn-sm btn-outline-primary">New Products</a>
    <!-- <a href="{{ route('dashboard.categories.trash') }}" class="btn btn-sm btn-outline-dark ml-2">Trash</a> -->
</div>

<x-alert type="success" />
<x-alert type="info" />

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
            <th>Name</th>
            <th>Category</th>
            <th>Store</th>
            <th>Status</th>
            <th>Created At</th>
        </tr>
    </thead>


    <tbody>

        @forelse($products as $product)
        <tr>
            <td>{{$product->id}}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->category()->first()->name}}</td>
            <td>{{$product->store->name}}</td>
            <td>{{$product->status}}</td>
            <td>{{$product->created_at}}</td>
            <td>
                <a href="{{route('dashboard.products.edit', $product->id)}}" class="btn btn-sm btn-outline-success">Edit</a>
            </td>

            <td>
                <form action="{{route('dashboard.products.destroy', $product->id)}}" method="post">
                    @csrf
                    <!-- Form Method Spoofing -->
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
            </td>

        </tr>
        @empty
        <tr>
            <td colspan="9">No Products defined.</td>
        </tr>
        @endforelse

    </tbody>
</table>

{{$products->withQueryString()->links()}}

@endsection