@extends('layouts.dashboard')

@section('title', 'Edit')



@section('breadcrumb')
@parent

<li class="breedcrumb-item active">Categories Edit</li>

@endsection




@section('content')

<form action="{{ route('dashboard.categories.update', $category->id)}} " method="post" enctype="multipart/form-data">
    @csrf
    @method('put')

    @include('dashboard.categories._form', [
    'btn_lable' => 'Update'

    ])

</form>

@endsection