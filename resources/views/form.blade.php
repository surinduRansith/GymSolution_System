@php
  use Carbon\Carbon;

// Get the current date
$currentDate = Carbon::now();

// Get the date of the same day in the next month
$nextMonthDate = $currentDate->copy()->addMonth();

// Format the dates as needed
$currentDateFormatted = $currentDate->format('Y-m-d'); // or any other format
$nextMonthDateFormatted = $nextMonthDate->format('Y-m-d'); // or any other format
@endphp
@extends('Layouts.app')

@section('content')

<div class="text-center pt-5">
    <h1>Members Registratoin</h1>
</div>
<br>

 <!-- Breadcrumb -->
 <nav aria-label="breadcrumb" class="main-breadcrumb">
  <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
  <li class="breadcrumb-item"><a href="{{route('members.data')}}">Member List</a></li>
  <li class="breadcrumb-item active" aria-current="page">Member Profile</li>
</ol>
</nav>
<!-- /Breadcrumb -->



<form action="{{route('insert.data')}}" method="post">
  @csrf
  <div class="text-center">
    <div class="row">
      <div class="col-6">
      <div class="input-group mb-3 " >
        <span class="input-group-text" id="basic-addon1">User Name</span>
        <input type="text" class="form-control" id="userName" aria-describedby="emailHelp" name="userName" value="{{old('userName')}}">
      </div>
      @error('userName')
      <p style="color: red">{{ $message }}</p>
  @enderror
      </div>
      <div class="col-6">
       <div class="input-group mb-3 " >
        <span class="input-group-text" id="basic-addon1">Date of Birth</span>
        <input type="date" class="form-control" id="dob" name="dob" value="{{old('dob')}}">
        
      </div>
      @error('dob')
      <p style="color: red">{{ $message }}</p>
  @enderror
      
      </div>
    </div>
    <div class="row">
    <div class="col-6">
        <div class="input-group mb-3 " >
          <span class="input-group-text" id="basic-addon1">Gender</span>
          <select class="form-select form-select-sm" aria-label="Default" name="gender" >
              <option selected>Please select Gender</option>
              <option value="male" {{old('gender')=='male'?'selected':''}}>Male</option>
              <option value="female" {{old('gender')=='female'?'selected':''}}>Female</option>
            </select>
      </div>
      @error('gender')
      <p style="color: red">{{ $message }}</p>
  @enderror
    </div>
    <div class="col-6">
     <div class="input-group mb-3 " >
      <span class="input-group-text" id="basic-addon1">Mobile Number</span>
      <input type="number" class="form-control" id="mobileNumber" name="mobileNumber" value="{{old('mobileNumber')}}" >
      
    </div>
    @error('mobileNumber')
    <p style="color: red">{{ $message }}</p>
@enderror
    </div>

    </div>

    <div class="row">
      <div class="col-6">
        <div class="input-group mb-3 " >
          <span class="input-group-text " id="basic-addon1">Membership Type</span>
          <select class="form-select form-select-sm" aria-label="Default" name="membershiptype" >
              <option >Please select membership type</option>
              <option value="Monthly" {{old('membershiptype')=='Monthly'?'selected':''}}>Monthly</option>
              <option value="Annual" {{old('membershiptype')=='Annual'?'selected':''}}>Annual</option>
            </select>
      </div>
      @error('membershiptype')
      <p style="color: red">{{ $message }}</p>
  @enderror
  </div>


  <div class="col-6">
    <div class="input-group mb-3">
      <input type="number" class="form-control" placeholder="Height" aria-label="height"id="height" name="height" value="{{old('height')}}" >
      <span class="input-group-text">@</span>
      <input type="text" class="form-control" placeholder="Weight" aria-label="weight" id="weight" name="weight" value="{{old('weight')}}">
    </div>
  
  </div>

</div>
<div class="row">
  <div class="col-6">
</div>


<div class="col-6">
  @error('height')
<p style="color: red">{{ $message }}</p>
@enderror

@error('weight')
<p style="color: red">{{ $message }}</p>
@enderror
</div>
</div>


<div class="row">
  <div class="col-6">
     <div class="input-group mb-3 " >
      <span class="input-group-text" id="basic-addon1">Start Date</span>
      <input type="date" class="form-control" id="startdate" name="startdate" value="{{$currentDateFormatted}}">
    </div>
    @error('startdate')
    <p style="color: red">{{ $message }}</p>
@enderror
  </div>
  <div class="col-6">
    <div class="input-group mb-3 " >
     <span class="input-group-text" id="basic-addon1">Expire Date</span>
     <input type="date" class="form-control" id="enddate" name="enddate" value="{{$nextMonthDateFormatted}}">
    </div>
    @error('enddate')
    <p style="color: red">{{ $message }}</p>
@enderror
</div> 
</div>
    <br>
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
  </form>
    
@endsection