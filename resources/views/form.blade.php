
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


<livewire:form-registration/>

    
@endsection