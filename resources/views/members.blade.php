

@extends('Layouts.app')

@section('content')

@if(session('success'))
<div class="alert alert-success" role="alert">
  {{ session('success') }}
</div>

@endif


 <!-- Breadcrumb -->
 <nav aria-label="breadcrumb" class="main-breadcrumb">
  <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
 
  <li class="breadcrumb-item active" aria-current="page">Member List</li>
</ol>
</nav>
<!-- /Breadcrumb -->

<div class="text-start pt-5">
  <a href="{{route('membersregistration.data')}}" class="btn btn-primary ">
    <i class="lni lni-user"></i>
    <span>Add Member </span>
</a>
</div>
<br>

<div class="table-responsive">
  <livewire:show-members/>


</div>


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