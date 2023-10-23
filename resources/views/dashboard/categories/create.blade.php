@extends('layouts.dashboard')

@section('title', 'Categories')



@section('breadcrumb')
@parent

<li class="breedcrumb-item active"><a href="">Categories Page</a></li>

@endsection




@section('content')

<form action="{{ route('dashboard.categories.store')}} " method="post" enctype="multipart/form-data">
    @csrf

    @include('dashboard.categories._form', [
    'btn_lable' => 'Create'
    ])

</form>

@endsection