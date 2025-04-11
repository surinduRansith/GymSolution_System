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
'Cardio Exercises & Equipment'];
@endphp

@extends('Layouts.app')

@section('content')
@if(session('success'))
<div class="alert alert-success" role="alert">
  {{ session('success') }}
</div>
@endif

<div class="container py-4">
  <div class="text-center mb-4">
    <h1 class="display-5 fw-bold">Schedule Type</h1>
  </div>

  <nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb bg-light px-3 py-2 rounded">
      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Schedule Type</li>
    </ol>
  </nav>

  <form action="{{route('exersice.add')}}" method="post">
    @csrf
    <div class="row g-3 align-items-center mb-4">
      <div class="col-md-4">
        <label for="schedulename" class="form-label">Add Exercise Name</label>
        <input type="text" class="form-control" id="schedulename" name="schedulename" value="{{old('schedulename')}}">
        @error('schedulename')
          <div class="text-danger small">{{ $message }}</div>
        @enderror
      </div>
      <div class="col-md-4">
        <label for="exercisetype" class="form-label">Exercise Type</label>
        <select class="form-select" name="exercisetype">
          <option selected disabled>Please select Exercise Type</option>
          @foreach ($exerciseTypes as $exercisetype)
            <option value="{{$exercisetype}}" {{old('exercisetype')==$exercisetype?'selected':''}}>{{$exercisetype}}</option>
          @endforeach
        </select>
        @error('exercisetype')
          <div class="text-danger small">{{ $message }}</div>
        @enderror
      </div>
      <div class="col-md-4 d-flex align-items-end">
        <button type="submit" class="btn btn-primary w-100">Add</button>
      </div>
    </div>
  </form>

  <div class="table-responsive mb-5">
    <table class="table table-striped" id="exercisetable">
      <thead class="table-dark">
        <tr>
          <th>Exercise Type</th>
          <th>Exercise Name</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($scheduleTypes as $scheduleType)
        <tr>
          <td>{{$scheduleType->exercise_type}}</td>
          <td>{{$scheduleType->name}}</td>
          <td></td>
        </tr> 
        @endforeach
      </tbody>
    </table>
  </div>

  <form action="{{route('schedulegroup.data')}}" method="post">
    @csrf
    <div class="mb-4">
      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Create Schedule
      </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create New Schedule</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input type="text" class="form-control mb-3" name="nameofschedule" placeholder="Schedule Name" value="{{old('nameofschedule')}}">
            <label class="form-label">Select Exercises</label>
            <select class="selectpicker form-control" data-live-search="true" name="exerciselist[]" multiple>
              @foreach ($scheduleTypes as $exercise)
              <option value="{{ $exercise->name }}">{{ $exercise->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add Schedule</button>
          </div>
        </div>
      </div>
    </div>
  </form>

  <div class="table-responsive">
    <table class="table table-bordered table-hover" id="myTable">
      <thead class="table-dark">
        <tr>
          <th>Schedule Name</th>
          <th>Exercise List</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($scheduleGroup as $scheduleType)
        <tr>
          <td>{{$scheduleType->scheduleName}}</td>
          <td>
            @php $exerciseList = json_decode($scheduleType->scheduleType_names); @endphp
            @foreach ($exerciseList as $exercise)
              <span class="badge bg-info text-dark">{{$exercise}}</span><br>
            @endforeach
          </td>
          <td>
            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{$scheduleType->id}}">
              <i class="lni lni-trash-can"></i>
            </button>
            <div class="modal fade" id="exampleModal{{$scheduleType->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Delete Schedule - {{$scheduleType->scheduleName}}?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <form action="{{route('scheduletype.delete',$scheduleType->id)}}" method="POST">
                      @csrf
                      @method('Delete')
                      <button type="submit" class="btn btn-danger">Yes</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
  $(document).ready(function() {
    $('#myTable').DataTable({ "lengthMenu": [10, 100, 200] });
    $('#exercisetable').DataTable({ "lengthMenu": [3, 5, 10, 50, 100, 200] });
  });
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
@endsection