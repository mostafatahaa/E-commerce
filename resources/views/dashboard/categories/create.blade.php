@extends('layouts.dashboard')

@section('title', 'Categories')



@section('breadcrumb')
@parent

<li class="breedcrumb-item active">Categories Page</li>

@endsection




@section('content')

<form action="{{ route('dashboard.categories.store')}} " method="post">
    @csrf
    <div class="form-group">
        <lable>Category Name</lable>
        <input type="text" name="name" class="form-control">
    </div>

    <div class="form-group">
        <lable for="">Category Parent</lable>
        <select name="parent_id" class="form-control form-select">
            <option value="">Primary Category</option>
            @foreach($parents as $parent)
            <option value="{{ $parent->id }}">{{$parent->name}}</option>
            @endforeach

        </select>
    </div>
    <div class="form-group">
        <lable>Descreption</lable>
        <textarea name="description" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <lable>Image</lable>
        <input type="file" name="image" class="form-control">
    </div>

    <div class="form-group">
        <lable for="">Status</lable>
        <div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" value="active" checked>
                <label class="form-check-label">
                    Active
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" value="archived">
                <label class="form-check-label">
                    Archived
                </label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-primary" type="submit">Save</button>
    </div>
</form>

@endsection