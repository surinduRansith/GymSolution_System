@php
use Illuminate\Support\Carbon;
     $daysArray = [
        'Sunday','Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday' 
    ];

    $currentMonthName = Carbon::now()->format('F');
    $currentYear = Carbon::now()->year;
    $currentDate = Carbon::today();
    $formattedDate = $currentDate->format('d');
    $today = $currentDate->format('Y-m-d');

    
    $monthName=$currentMonthName;
@endphp
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

@foreach ($attendances as $attendance )

                            @if ($attendance->attendancedate==$attendance->attendancedate)
                              @php
                                  $datemark=$attendance->attendancedate;
                              @endphp
                            @endif
                            @endforeach
<div class="table-responsive">

    @if(session('success'))
<div class="alert alert-success" role="alert">
  {{ session('success') }}
</div>
@endif

<form action="{{route('attendance.show',$member->id)}}" >
    
@csrf
    <input type="number" hidden value="{{$monthindex}}" name="month">
    
    <input type="test" hidden value="{{ $monthsnames[$monthindex] }}" name="monthname">

 

    @foreach ($months as $month)

    

    @if ($month['name'] == $monthsnames[$monthindex])


    <div class="container text-center">
        <h2><button type="submit" name="monthcount" value="min" class="btn btn-outline-info"><i class="fa-solid fa-angle-right fa-rotate-180"></i></button>
            {{ $month['name'] }} {{ $year }} 
            <button type="submit" name="monthcount" value="add" class="btn btn-outline-info"><i class="fa-solid fa-angle-right"></i></button></h2>
        <br>
    </form>
        <table class="table table-striped ">
            <thead>
                <tr>
                    @foreach ($month['daysArray'] as $day)
                        <th>{{ $day }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr>
                    @for ($i = 0; $i < $month['dates'][0]->dayOfWeek; $i++)
                        <td></td>
                    @endfor

                    @foreach ($month['dates'] as $date)
                        {{-- <td>{{ $date->day }}</td> --}}

                        @php
                        $formattedDate = $year . '-' . $month['monthname'] . '-' . $date->format('d');
                        $add = '';
                        $modal = 'modal';
                        $msg=false;
                    @endphp
                 
                    
                        @if(in_array($formattedDate, $month['mark']))
                    @php
                        $add='table-primary';
                        $msg = true;
                        $modal='';
                    @endphp
                        @elseif($formattedDate==$today)
                        @php
                        $add='table-success';
                        $modal='modal';

                        $msg=false;
                        @endphp
                        @endif
                       
                        <td  data-bs-toggle="{{$modal}}" data-bs-target="#exampleModal{{ $date->format('d') }}" class="{{$add}}" > 
                           
                            {{$date->format('d') }}
                            
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $date->format('d') }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Attendance Mark</h1>
      
        </div>
        <div class="modal-body">
           
            {{ $year .'-'.$month['monthname'].'-'.$date->format('d') }}

            
            
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            @foreach ($members as $member )
            
          <form action="{{route('attendance.insert', $member->id)}}" method="POST">
            @csrf
            <input type="number" value="1" name="attendance" hidden>
            <input type="text" value="{{ $year .'-'.$month['monthname'].'-'.$date->day }}" name="attendancedate" hidden>
            <button type="submit" class="btn btn-primary">Mark Attendance</button>
            @endforeach
        </form>
   
        
    </div>
</div>
    </div>
  </div>
  <div>
  @if ($msg==true)
 
  <i class="fa-duotone fa-solid fa-dumbbell fa-xl" style="--fa-primary-color: #103cea; --fa-secondary-color: #ea1010;"></i>
  
  @endif
  </div>                  
                    </td>

                        @if ($date->dayOfWeek == Carbon::SATURDAY && !$loop->last)
                            </tr><tr>
                        @endif
                    @endforeach

                    @php
                        $lastDayOfWeek = end($month['dates'])->dayOfWeek;
                    @endphp

                    @for ($i = $lastDayOfWeek + 1; $i <= Carbon::SATURDAY; $i++)
                        <td></td>
                    @endfor
                </tr>
            </tbody>
        </table>
    </div>
    @endif
       
    @endforeach

   
</div>


@endsection
