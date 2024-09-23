@php
      use Illuminate\Support\Carbon;

$currentMonthName = Carbon::now()->format('F');
$currentMonthNumber = Carbon::parse($currentMonthName)->format('m');
$datesArray = [];
$dailycount=[];
    @endphp
<x-app-layout>
    @section('content')
    
 
        <div class="row">
            <div class="col-4 ">
                <div class="card text-bg-success position-relative">
                    <a href="{{ route('members.data') }}" class="text-decoration-none text-reset">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-9">
                                    <h5 class="card-title">Members</h5>
                                    <h6 class="card-subtitle mb-2 text-body-secondary">Count of Members</h6>
                                    <h4>{{ $userscount }}</h4>
                                </div>
                                <div class="col-3 d-flex justify-content-end align-items-start">
                                    <i class="fa-solid fa-users" style="font-size: 5rem;"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                
            </div>
            <div class="col-4">
                    <div class="card text-bg-info position-relative">
                    <a href="{{ route('members.data') }}" class="text-decoration-none text-reset">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-9">
                                    <h5 class="card-title">Active Members</h5>
                                    <h6 class="card-subtitle mb-2 text-body-secondary">Count of active members</h6>
                                    <h4>{{ $userscountactive }}</h4>
                                </div>
                                <div class="col-3 d-flex justify-content-end align-items-start">
                                    <i class="fa-solid fa-user-check" style="font-size: 5rem;"></i>
                                   
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
            <div class="col-4">
                <div class="card text-bg-danger position-relative">
                    <a href="{{ route('members.data') }}" class="text-decoration-none text-reset">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-9">
                                    <h5 class="card-title">Inactive Members</h5>
                                    <h6 class="card-subtitle mb-2 text-body-secondary">Count of inactive members</h6>
                                    <h4>{{ $userscountinactive }}</h4>
                                </div>
                                <div class="col-3 d-flex justify-content-end align-items-start">
                                    <i class="fa-solid fa-users-slash" style="font-size: 5rem;"></i>
                                   
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

        </div>
        <br>
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('dashboard')}}">
                            @csrf

                     <h5 class="card-title text-center">
    <button type="submit" name="monthcount" value="min" class="btn btn-outline-info me-2">
        <i class="fa-solid fa-angle-right fa-rotate-180"></i>
    </button>
    {{$monthsnames[$monthindex]}}
    <button type="submit" name="monthcount" value="add" class="btn btn-outline-info ms-2">
        <i class="fa-solid fa-angle-right"></i>
    </button>
</h5>


<input type="number" hidden value="{{$monthindex}}" name="month">
<input type="test" hidden  value="{{ $monthsnames[$monthindex] }}" name="monthname">
                     
                            @foreach ($userAttendancecount as $userAttendance)
                        
                            @php
                                
                               $dailycount[] = $userAttendance->daily_count;
                               $datesArray[] = substr($userAttendance->attendancedate, -2);
                               
                               
                            @endphp

                           
                                 
                            @endforeach
                        </form>   

                      
                      <div>
                        <canvas id="myChart"></canvas>
                    </div>
                    
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const ctx = document.getElementById('myChart').getContext('2d');
                            
                    
                            new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: @json($datesArray),
                                    datasets: [{
                                        label: 'Daily Attendancee Count',
                                        data: @json($dailycount), // Make sure this is a valid array
                                        borderWidth: 2,
                                        borderColor: 'rgba(75, 192, 192, 1)',
                                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                        });
                    </script>
                      
                    </div>
                  </div>
            </div>
            <div class="col-3">
                <div class="card text-bg-warning" >
                    <div class="card-body ">
                      <h5 class="card-title">Monthly Income</h5>
                      <h6 class="card-subtitle mb-2 text-body-secondary">{{$monthsnames[$monthindex]}}</h6>

                      <h4 class="card-subtitle mb-2 text-body-primary mt-5">Rs . {{$monthlyincome}}.00</h4>

                    </div>
                  </div>
            </div>
            <div class="col-3">
                <div class="card" >
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>
                    
                    </div>
                  </div>
            </div>

        </div>

    
@endsection
</x-app-layout>
