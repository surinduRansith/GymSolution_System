@extends('Layouts.app')
@section('content')
@if (session('success'))
    <p>done</p>
@endif

<table class="table  table-striped table-responsive-sm   " id="myTable">
    <thead>
        <th>Name</th>
        <th>Email</th>
    </thead>
    <tbody>
@foreach ($userList as $user) 
<tr>
    <td>{{$user->name}}</td>
    <td>{{$user->email}}</td>
</tr>
@endforeach
    </tbody>
</table>
    
@endsection