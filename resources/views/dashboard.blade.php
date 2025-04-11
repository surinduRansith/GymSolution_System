@php
use Illuminate\Support\Carbon;

$currentMonthName = Carbon::now()->format('F');
$currentMonthNumber = Carbon::parse($currentMonthName)->format('m');
$datesArray = [];
$dailycount = [];
@endphp

<x-app-layout>
  @section('content')

  <div class="container-fluid px-4">
    <div class="row g-4 mb-4">
      <!-- Members -->
      <div class="col-md-4">
        <div class="card shadow-sm border-0 bg-success text-white h-100 hover-shadow">
          <a href="{{ route('members.data') }}" class="text-decoration-none text-white">
            <div class="card-body d-flex justify-content-between align-items-center">
              <div>
                <h5 class="card-title">Members</h5>
                <h6 class="card-subtitle mb-2">Count of Members</h6>
                <h4>{{ $userscount }}</h4>
              </div>
              <i class="fa-solid fa-users fa-3x"></i>
            </div>
          </a>
        </div>
      </div>

      <!-- Active Members -->
      <div class="col-md-4">
        <div class="card shadow-sm border-0 bg-info text-white h-100 hover-shadow">
          <a href="{{ route('members.data') }}" class="text-decoration-none text-white">
            <div class="card-body d-flex justify-content-between align-items-center">
              <div>
                <h5 class="card-title">Active Members</h5>
                <h6 class="card-subtitle mb-2">Count of Active Members</h6>
                <h4>{{ $userscountactive }}</h4>
              </div>
              <i class="fa-solid fa-user-check fa-3x"></i>
            </div>
          </a>
        </div>
      </div>

      <!-- Inactive Members -->
      <div class="col-md-4">
        <div class="card shadow-sm border-0 bg-danger text-white h-100 hover-shadow">
          <a href="{{ route('members.data') }}" class="text-decoration-none text-white">
            <div class="card-body d-flex justify-content-between align-items-center">
              <div>
                <h5 class="card-title">Inactive Members</h5>
                <h6 class="card-subtitle mb-2">Count of Inactive Members</h6>
                <h4>{{ $userscountinactive }}</h4>
              </div>
              <i class="fa-solid fa-users-slash fa-3x"></i>
            </div>
          </a>
        </div>
      </div>
    </div>

    <div class="row g-4">
      <!-- Chart Card -->
      <div class="col-md-6">
        <div class="card shadow-sm border-0 h-100">
          <div class="card-body">
            <form action="{{ route('dashboard') }}">
              @csrf
              <div class="text-center mb-3">
                <button type="submit" name="monthcount" value="min" class="btn btn-outline-info me-2">
                  <i class="fa-solid fa-angle-left"></i>
                </button>
                <strong>{{ $monthsnames[$monthindex] }}</strong>
                <button type="submit" name="monthcount" value="add" class="btn btn-outline-info ms-2">
                  <i class="fa-solid fa-angle-right"></i>
                </button>
              </div>
              <input type="hidden" name="month" value="{{ $monthindex }}">
              <input type="hidden" name="monthname" value="{{ $monthsnames[$monthindex] }}">
              @foreach ($userAttendancecount as $userAttendance)
                @php
                  $dailycount[] = $userAttendance->daily_count;
                  $datesArray[] = substr($userAttendance->attendancedate, -2);
                @endphp
              @endforeach
            </form>
            <canvas id="myChart" style="height: 320px;"></canvas>
          </div>
        </div>
      </div>

      <!-- Carousel + Income -->
      <div class="col-md-6">
        <div class="card shadow-sm border-0 mb-3">
          <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner rounded">
              @foreach (['1.jpg', '2.jpg', '3.jpg', '4.jpg'] as $i => $img)
                <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                  <img src="{{ asset('images/' . $img) }}" class="d-block w-100" style="height: 325px; object-fit: cover;" alt="{{ $img }}">
                </div>
              @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
              <span class="carousel-control-prev-icon"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
              <span class="carousel-control-next-icon"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>

        <div class="card shadow-sm border-0 bg-warning text-dark">
          <div class="card-body">
            <h5 class="card-title">Monthly Income</h5>
            <h6 class="card-subtitle">{{ $monthsnames[$monthindex] }}</h6>
            <h4 class="mt-3">Rs. {{ $monthlyincome }}.00</h4>
          </div>
        </div>
      </div>
    </div>
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
            fill: true,
            tension: 0.4
          }]
        },
        options: {
          responsive: true,
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    });
  </script>

  @endsection
</x-app-layout>
