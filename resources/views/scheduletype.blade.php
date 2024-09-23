@php

$exerciseTypes = ['Chest Exercises',
'Shoulder Exercises',
'Bicep Exercises',
'Triceps Exercises',
'Leg Exercises',
'Back Exercises',
'Glute Exercises',
'Ab Exercises',
'Calves Exercises',
'Forearm Flexors & Grip Exercises',
'Forearm Extensor Exercises',
'Cardio Exercises & Equipment'
];

@endphp

@extends('Layouts.app')



@section('content')

<div class="text-center pt-2">
    <h1>Schedule Type</h1>
</div>
<br>

 <!-- Breadcrumb -->
 <nav aria-label="breadcrumb" class="main-breadcrumb">
  <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
  {{-- <li class="breadcrumb-item"><a href="{{route('members.data')}}">Schedule Type</a></li> --}}
  <li class="breadcrumb-item active" aria-current="page">Schedule Type</li>
</ol>
</nav>
<!-- /Breadcrumb -->



<form action="{{route('exersice.add')}}" method="post">
  @csrf
  <div class="container text-center">
    <div class="row">
      <div class="col-4">
      <div class="input-group mb-3 " >
        <span class="input-group-text" id="basic-addon1">Add Schedule Type</span>
        <input type="text" class="form-control" id="schedulename" aria-describedby="emailHelp" name="schedulename" value="{{old('schedulename')}}">
      </div>
      @error('schedulename')
      <p style="color: red">{{ $message }}</p>
  @enderror
      </div>
      <div class="col-4">
        <div class="input-group mb-3 " >
          <span class="input-group-text " id="basic-addon1">Exercise Type</span>
          <select class="form-select form-select-sm" aria-label="Default" name="exercisetype" >
              <option selected>Please select Exercise Type</option>
              @foreach ($exerciseTypes as $exercisetype )
              <option value="{{$exercisetype}}" {{old('exercisetype')==$exercisetype?'selected':''}}>{{$exercisetype}}</option>
              @endforeach
              {{-- <option value="monthly" {{old('membershiptype')=='monthly'?'selected':''}}>Chest Exercises</option>
              <option value="annual" {{old('membershiptype')=='annual'?'selected':''}}>Shoulder Exercises</option> --}}
            </select>
         
      </div>
      @error('exercisetype')
      <p style="color: red">{{ $message }}</p>
  @enderror
        </div>
      <div class="col-4">
        <div class="input-group mb-3 " >
            <button type="submit" class="btn btn-primary"><i class="lni lni-plus"></i>Add</button>
        </div>
    <br>
    
  </div>
  </form>
















  
  <table class="table  table-striped table-responsive-sm   " id="myTable">
    <thead>
      <th>Exercise Type</th>
      <th>Exercise Name</th>
    </thead>
    <tbody>
      @foreach ($scheduleTypes as $scheduleType )
<tr>
  <td>{{$scheduleType->exercise_type}}</td>
  <td>{{$scheduleType->name}}</td>
</tr>   
  @endforeach
</tbody>
</table>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    $('#myTable').DataTable({

        "lengthMenu": [10, 100, 200],
        

    });
});
</script>
@endsection


