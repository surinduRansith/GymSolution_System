
@extends('Layouts.app')
@section('content')

<style>
    .table, .table th, .table td {
        border: 1px solid #dee2e6; /* Adjust color as needed */
    }

</style>


 <!-- Breadcrumb -->
 <nav aria-label="breadcrumb" class="main-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('members.data')}}">Member List</a></li>
    @foreach ($members as $member )
    <li class="breadcrumb-item"><a href="{{route('members.profile',$member->id)}}">Member Profile</a></li>
    @endforeach
    <li class="breadcrumb-item active" aria-current="page">Attendance</li>
  </ol>
</nav>
<!-- /Breadcrumb -->


    <livewire:attendance-calender :id="$member->id"  />


@endsection
