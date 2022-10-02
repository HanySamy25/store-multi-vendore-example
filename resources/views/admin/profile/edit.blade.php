@extends('admin.layout.main')

@section('title', 'Edit Profile')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Edit Profile</li>
@endsection

@section('content')
{{-- {{ dd($errors->any()) }}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}
<x-alert type="success" />
{{-- {{ dd($user) }} --}}

<form action="{{ route('admin.profile.update') }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('patch')

    <div class="form-row">
        <div class="col-md-6">
            <x-form.input name="first_name" label="First Name" :value="$user?->profile?->first_name" />
        </div>
        <div class="col-md-6">
            <x-form.input name="last_name" label="Last Name" :value="$user?->profile?->last_name" />
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-6">
            <x-form.input name="birthday" type="date" label="Birthday" :value="$user->profile?->birthday" />
        </div>
        <div class="col-md-6">
            {{-- <input type="radio" name="gender" value="male" {{ $user->profile->gender=='male'?'checked':'' }} id="">male
            <input type="radio" name="gender" value="female" {{ $user->profile->gender=='female'?'checked':'' }} id="">female --}}
            <x-form.radio name="gender" label="Gender" :options="['male'=>'Male', 'female'=>'Female']" :checked="$user->profile?->gender" />
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-4">
            <x-form.input name="street_address" label="Street Address" :value="$user->profile?->street_address" />
        </div>
        <div class="col-md-4">
            <x-form.input name="city" label="City" :value="$user->profile?->city" />
        </div>
        <div class="col-md-4">
            <x-form.input name="state" label="State" :value="$user->profile?->state" />
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-4">
            <x-form.input name="postal_code" label="Postal Code" :value="$user->profile?->postal_code" />
        </div>
        <div class="col-md-4">
            <x-form.select name="country" :options="$countries" label="Country" :selected="$user->profile?->country" />
        </div>
        <div class="col-md-4">
            <x-form.select name="locale" :options="$locales" label="Locale" :selected="$user->profile?->locale" />
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
</form>

@endsection
