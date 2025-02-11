@extends('Layouts.app')
@section('content')


@if (!empty($schedules))

@foreach ($schedules as $schedule )

<h1 >{{$schedule->scheduleName}}</h1>

@php
  $memberid = $schedule->member_id;
  
@endphp
@endforeach
<table class="table  table-primary table-striped">
  <thead>
    <th>Exersice Name</th>
    <th>No Of Sets</th>
    <th>No of Time</th>
    
  </thead>
  <tbody>

      <form action="{{ route('updateshedulemember.insert', ['id' => $schedule->member_id, 'scheduleid' => $schedule->scheduleType_id]) }}" method="POST">
        @csrf

      @foreach ($schedules as $schedule )


    
    @php
   $exerciseList = json_decode($schedule->scheduleType_names);
   @endphp
@foreach ($exerciseList as $index => $exercise)


<tr>
<td >{{$exercise}}<input type="text" hidden class="form-control" value="{{$exercise}}" name="exercisename{{$index}}"></td>
<td><input type="number" class="form-control" value="{{ empty($countofexercises[$index]->noofsets) ? old('noofsets'.$index) : $countofexercises[$index]->noofsets }}" name="noofsets{{$index}}"
   {{empty($countofexercises[$index]->noofsets) ? '' : "disabled" }}
  > </td>
  @error('noofsets'.$index)
  <p style="color: red">{{ $message }}</p>
@enderror
<td><input type="number" class="form-control" value="{{ empty($countofexercises[$index]->nooftime) ? '3' : $countofexercises[$index]->nooftime }}" name="nooftime{{$index}}" 
  {{empty($countofexercises[$index]->nooftime) ? '' : "disabled" }}
  > </td>
</tr>
@endforeach
<tr>
  
  @endforeach
  <td colspan="3" class="align-middle"> 
    <div class="text-center">
      <a href="{{route('members.profile', ['id' =>$schedule->member_id])}}" class="btn btn-sm btn-danger " >Cancel</a>
      <button type="submit" class="btn btn-sm btn-primary " {{empty($countofexercises[$index]->nooftime) ? '' : "disabled" }}>update</button>

      @if(!empty($countofexercises[$index]->nooftime))

      <a href="{{route('memberschedulelist.data',['id' => $schedule->member_id, 'scheduleid' => $schedule->scheduleType_id])}}" class="btn btn-sm btn-warning " ><i class="lni lni-download"></i></a>

      @endif
</div> 
</td>
</form>
</tr>
</tbody>
</table>

@endif





@endsection