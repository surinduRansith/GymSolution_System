@php
    use Illuminate\Support\Carbon;

$startDate = Carbon::now()->startOfMonth()->format('Y-m-d'); // First day of the month
$endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
@endphp
@extends('Layouts.app')
@section('content')
<div class="text-center pt-2">
    <h1>Attendance Report</h1>
</div>
<br>
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="main-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Attendance Report</li>
  </ol>
  </nav>
  <!-- /Breadcrumb -->
<div class="row ">
<form action="{{route('attendancereport1.show')}}" method="POST">
    @csrf
<div class="row">
    <div class="col-3">
        
            <select class="form-select select2  " aria-label="Default" name="memberid" >
                <option selected>Search Member</option>
                @foreach ($members as $member )
                <option value="{{$member->id}}" {{old('memberid')==$member->id?'selected':''}}>{{$member->name}}</option>
           
@endforeach 
              </select>  
              @error('memberid')
              <p style="color: red">{{ $message }}</p>
          @enderror
    </div>
    <div class="col-1">
    </div>
    <div class="col-3">
       <div class="input-group mb-3 " >
        <span class="input-group-text" id="basic-addon1">Start Date</span>
        <input type="date" class="form-control" id="startdate" name="startdate" value="{{$startDate}}">
      </div>
      @error('startdate')
      <p style="color: red">{{ $message }}</p>
  @enderror
    </div>
    <div class="col-3">
      <div class="input-group mb-3 " >
       <span class="input-group-text" id="basic-addon1">End Date</span>
       <input type="date" class="form-control" id="enddate" name="enddate" value="{{$endDate}}">
      </div>
      @error('enddate')
      <p style="color: red">{{ $message }}</p>
  @enderror
  </div> 

  <div class="col-2">
    <button type="submit" class="btn btn-primary">Search</button>
</div> 
  </div>

</form>
</div>
@if(count($userAttendance)>0)

<div class="row">
    <div class="col-10">
        
    </div>
<div class="col-2">
    <button type="button" class="btn btn-sm btn-danger"  title="Download PDF">
       <i class="fa-solid fa-file-pdf"></i>
      </button>
      <button type="button" class="btn btn-sm btn-danger">
       <i class="fa-solid fa-file-pdf"></i>
      </button>
      <button type="button" class="btn btn-sm btn-danger">
       <i class="fa-solid fa-file-pdf"></i>
      </button>
      <button type="button" class="btn btn-sm btn-danger">
       <i class="fa-solid fa-file-pdf"></i>
      </button>
</div>
</div>
<br>
<div class="row">
    <div class="table-responsive">
        <table class="table " id="myTable" >
            <thead class="table-secondary">
              <td>Member ID</td>
              <td>Member Name</td>
              <td>Month</td>
              <td>Attendance Date</td>
            </thead>
            <tbody>
        @foreach ($userAttendance as $att )

        @php
            $date = $att->attendancedate;
$dateTime = new DateTime($date);
$monthName = $dateTime->format('F'); // Full month name (e.g., August)
        @endphp
        
        <tr >
            <td>{{$att->member_id}}</td>
            <td> {{$att->name}}</td>
            <td>{{$monthName }}</td>
            <td>{{$att->attendancedate}}</td>

          </tr>
        
            
        @endforeach
        
        </tbody>
        </table>
        </div>

</div>

@else
<div class="row">

    <div class="alert alert-warning text-center" role="alert">
        Please Generate Attendance Report
      </div>

</div>
@endif












<script>

    var select_box_element = document.querySelector('#memberid');

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


@endsection