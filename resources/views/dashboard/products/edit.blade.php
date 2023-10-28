@extends('layouts.dashboard')

@section('title', 'Products')



@section('breadcrumb')
@parent

<li class="breedcrumb-item active">Products Edit</li>

@endsection




@section('content')

<form action="{{ route('dashboard.products.update', $product->id)}} " method="post" enctype="multipart/form-data">
    @csrf
    @method('put')

    @include('dashboard.products._form', [
    'btn_lable' => 'Update'

    ])

</form>

@endsection