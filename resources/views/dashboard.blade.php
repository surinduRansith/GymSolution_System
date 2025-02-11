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
                <div class="card" style=" height: 500px;">
                    <div class="card-body" style="height: 100%; padding: 20px;">
                      <form action="{{route('dashboard')}}">
                        @csrf
                        <h5 class="card-title text-center" style="margin-bottom: 20px;">
                          <button type="submit" name="monthcount" value="min" class="btn btn-outline-info me-2">
                            <i class="fa-solid fa-angle-right fa-rotate-180"></i>
                          </button>
                          {{$monthsnames[$monthindex]}}
                          <button type="submit" name="monthcount" value="add" class="btn btn-outline-info ms-2">
                            <i class="fa-solid fa-angle-right"></i>
                          </button>
                        </h5>
                  
                        <input type="number" hidden value="{{$monthindex}}" name="month">
                        <input type="text" hidden value="{{ $monthsnames[$monthindex] }}" name="monthname">
                  
                        @foreach ($userAttendancecount as $userAttendance)
                          @php
                            $dailycount[] = $userAttendance->daily_count;
                            $datesArray[] = substr($userAttendance->attendancedate, -2);
                          @endphp
                        @endforeach
                      </form>
                  
                      <!-- Chart Section -->
                      <div style="height: calc(100% - 80px);">
                        <canvas id="myChart" style="width: 100%; height: 100%;"></canvas>
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
                                label: 'Daily Attendance Count',
                                data: @json($dailycount),
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
            <div class="col-6">
                <div class="pt-1">
                    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel" style=" max-height: 400px; margin: 0 auto;">
                      <div class="carousel-inner">
                        <div class="carousel-item active rounded">
                          <img src="{{asset('images/1.jpg')}}" class="d-block w-100" style="height: 325px; object-fit: cover; border-radius: 8px;" alt="1">
                        </div>
                        <div class="carousel-item">
                          <img src="{{asset('images/2.jpg')}}" class="d-block w-100" style="height: 325px; object-fit: cover; border-radius: 8px;" alt="2">
                        </div>
                        <div class="carousel-item">
                          <img src="{{asset('images/3.jpg')}}" class="d-block w-100" style="height: 325px; object-fit: cover; border-radius: 8px;" alt="3">
                        </div>
                        <div class="carousel-item">
                          <img src="{{asset('images/4.jpg')}}" class="d-block w-100" style="height: 325px; object-fit: cover; border-radius: 8px;" alt="4">
                        </div>
                      </div>
                      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                      </button>
                      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                      </button>
                    </div>
                  </div>
                  

                  <div class="card text-bg-warning mt-3" style=" height: 150px;">
                    <div class="card-body">
                      <h5 class="card-title">Monthly Income</h5>
                      <h6 class="card-subtitle mb-2 text-body-secondary">{{$monthsnames[$monthindex]}}</h6>
                      <h4 class="card-subtitle mb-2 text-body-primary mt-3">Rs. {{$monthlyincome}}.00</h4>
                    </div>
                  </div>
                  
                 
            </div>
            
            
            
        </div>
        
      

       
    
@endsection
</x-app-layout>
