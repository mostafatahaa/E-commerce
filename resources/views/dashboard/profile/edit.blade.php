@extends('layouts.dashboard')

@section('title', 'Edit')



@section('breadcrumb')
@parent

<li class="breedcrumb-item active">Edit Profle</li>

@endsection




@section('content')

<x-alert type="success" />

<form action="{{route('dashboard.profile.update')}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('patch')

    <div class="form-row">
        <div class="col-md-6">
            <x-form.input name="first_name" label="First Name" :value="$user->profile->first_name" />
        </div>
        <div class="col-md-6">
            <x-form.input name="last_name" label="Last Name" :value="$user->profile->last_name" />
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-6">
            <x-form.input name="birthday" label="Birthday" type="date" :value="$user->profile->birthday" />
        </div>
        <div class="col-md-6">
            <x-form.radio name="gender" label="Gender" :options="['male' => 'Male', 'female' => 'Female']" :checked="$user->profile->gender" />
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-4">
            <x-form.input name="street_address" label="Street Adress" :value="$user->profile->street_address" />
        </div>
        <div class="col-md-4">
            <x-form.input name="city" label="City" :value="$user->profile->city" />
        </div>
        <div class="col-md-4">
            <x-form.input name="state" label="State" :value="$user->profile->state" />
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-4">
            <x-form.input name="postal_code" label="Postal Code" :value="$user->profile->postal_code" />
        </div>
        <div class="col-md-4">
            <x-form.select name="country" label="Country" :options="$countries" :selected="$user->profile->country" />
        </div>
        <div class="col-md-4">
            <x-form.select name="locale" label="Local" :options="$locals" :selected="$user->profile->locale" />
        </div>
    </div>

    <button class="btn btn-primary mt-4" type="submit">Save</button>
</form>

@endsection