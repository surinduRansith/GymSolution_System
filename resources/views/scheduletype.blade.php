
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
@if(session('success'))
<div class="alert alert-success" role="alert">
  {{ session('success') }}
</div>

@endif
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
        <span class="input-group-text" id="basic-addon1">Add Exercise Name</span>
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

  <form action="{{route('schedulegroup.data')}}" method="post">
    @csrf
    <div class="row">
      
      <div class="col-2">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
          Create Schedule
        </button>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body ">
      
     
        <div class="pt-3">
          <input type="text" class="form-control" id="nameofschedule" aria-describedby="emailHelp" name="nameofschedule" value="{{old('nameofschedule')}}">
          
        </div>
        <div class="pt-3 ">
          <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Select Exercise</span>
            <select class="selectpicker "data-live-search="true" name="exerciselist[]" multiple>
              <option disabled data-live-search="true">Select Exercise</option>
            @foreach ($scheduleTypes as $exercise)
            <option value="{{ $exercise->name }}">{{ $exercise->name }}</option>
            @endforeach
          </select>
        </div>
        
        
      </div>
      
      
      
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary">Add Schduele</button>
    </div>

  </div>
</div>
</div>
  </div>
  
</form>
  
  <div class="col-10">
  
           </div>
          
            

</div>
<br><br><br>




<table class="table  table-striped table-responsive-sm   " id="myTable">
  <thead>
    <th>Exercise Type</th>
      <th>Exercise Name</th>
      <th></th>
      
    </thead>
    <tbody>
      @foreach ($scheduleGroup as $scheduleType )
<tr>
  <td>{{$scheduleType->scheduleName}}</td>
    @php
    // Decode the JSON array
    $exerciseList = json_decode($scheduleType->scheduleType_names);

@endphp
<td>
  @foreach ($exerciseList as $exercise)
  {{$exercise}}<br>
  @endforeach
</td>
<td><button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{$scheduleType->id}}">
  <i class="lni lni-trash-can"></i>
</button>
<!-- Modal -->
<div class="modal fade" id="exampleModal{{$scheduleType->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Do You Want to Delete This Schedule - {{$scheduleType->scheduleName}}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        {{-- <form action="{{route('membersdelete.delete',$scheduleType->id)}}" method="POST">
          @csrf
          @method('Delete') --}}
        <button type="submit" class="btn btn-danger">Yes</button>
      {{-- </form> --}}
      </div>
    </div>
  </div>
</div>
</td>
</tr>   
  @endforeach
</tbody>
</table>

    <script>

        var select_box_element = document.querySelector('#exerciselistp[]');
    
        dselect(select_box_element, {
            search: true
        });
    
    </script>
    <script>
    $('.select2').select2();
    </script>
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


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
@endsection


