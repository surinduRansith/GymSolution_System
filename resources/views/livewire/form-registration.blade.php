@php
use Carbon\Carbon;

$currentDateFormatted = Carbon::now()->format('Y-m-d');
$nextMonthDateFormatted = Carbon::now()->copy()->addMonth()->format('Y-m-d');
@endphp

<form wire:submit.prevent="submit" method="POST">
    @csrf
    <div class="container py-4 px-3 bg-light rounded shadow">

        <h3 class="text-center mb-4">Membership Registration</h3>

        {{-- Row 1 --}}
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="userName" class="form-label">User Name</label>
                <input type="text" wire:model.live="userName" class="form-control" id="userName" name="userName" value="{{ old('userName') }}">
                @error('userName') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" wire:model.live="dob" class="form-control" id="dob" name="dob" value="{{ old('dob') }}">
                @error('dob') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        {{-- Row 2 --}}
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-select" id="gender" name="gender" wire:model.live="gender">
                    <option selected disabled>Please select Gender</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                </select>
                @error('gender') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6">
                <label for="mobileNumber" class="form-label">Mobile Number</label>
                <input type="number" class="form-control" id="mobileNumber" name="mobileNumber" wire:model.live="mobileNumber" value="{{ old('mobileNumber') }}">
                @error('mobileNumber') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        {{-- Row 3 --}}
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="membershiptype" class="form-label">Membership Type</label>
                <select class="form-select" id="membershiptype" name="membershiptype" wire:model.live="membershiptype">
                    <option disabled selected>Please select membership type</option>
                    <option value="Monthly" {{ old('membershiptype') == 'Monthly' ? 'selected' : '' }}>Monthly</option>
                    <option value="Annual" {{ old('membershiptype') == 'Annual' ? 'selected' : '' }}>Annual</option>
                </select>
                @error('membershiptype') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Height & Weight</label>
                <div class="input-group">
                    <input type="number" wire:model.live="height" class="form-control" placeholder="Height (cm)" id="height" name="height" value="{{ old('height') }}">
                    <input type="text" wire:model.live="weight" class="form-control" placeholder="Weight" id="weight" name="weight" value="{{ old('weight') }}">
                </div>
                @error('height') <small class="text-danger d-block">{{ $message }}</small> @enderror
                @error('weight') <small class="text-danger d-block">{{ $message }}</small> @enderror
            </div>
        </div>

        {{-- Row 4 --}}
        <div class="row mb-4">
            <div class="col-md-6">
                <label for="startdate" class="form-label">Start Date</label>
                <input type="date" wire:model.live="startdate" class="form-control" id="startdate" name="startdate" value="{{ $currentDateFormatted }}">
                @error('startdate') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6">
                <label for="enddate" class="form-label">Expire Date</label>
                <input type="date" class="form-control" id="enddate" name="enddate" wire:model.live="enddate" value="{{ $nextMonthDateFormatted }}">
                @error('enddate') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        {{-- Submit --}}
        <div class="text-center">
            <button type="submit" class="btn btn-primary px-5">
                Submit
                <span class="spinner-border spinner-border-sm ms-2" wire:loading></span>
            </button>
        </div>
    </div>
</form>
