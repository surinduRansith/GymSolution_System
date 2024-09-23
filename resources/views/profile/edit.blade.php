@extends('layouts.app')
@section('content')

<x-slot name="header">
    <h2 class="h4 text-dark">
        {{ __('Profile') }}
    </h2>
</x-slot>

<div class="py-4">
    <div class="container">
        <div class="row g-4">
            <div class="col-12 col-md-8 offset-md-2">
                <!-- Update Profile Information -->
                <div class="card mb-4">
                    <div class="card-body">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Update Password -->
                <div class="card mb-4">
                    <div class="card-body">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- Delete User -->
                <div class="card mb-4">
                    <div class="card-body">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection