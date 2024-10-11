<div>
    <div class="card">
        <div class="card-body"> 
   

          <h5 class="card-title text-center">
            <button type="button" wire:click="decreasemonth" wire:model="monthcount" name="monthcount" class="btn btn-outline-info">
                <i class="fa-solid fa-angle-right fa-rotate-180"></i>
            </button>
            {{$monthsnames[$monthindex]}}  {{$monthindex}} {{$firstDayOfMonth.' - '.$lastDayOfMonth}}
<button type="button" wire:click="increasemonth" wire:model="monthcount" name="monthcount" class="btn btn-outline-info">
    <i class="fa-solid fa-angle-right"></i>
</button>
</h5>



         
                @foreach ($userAttendancecount as $userAttendance)
            
                @php
                    
                   $dailycount[] = $userAttendance->daily_count;
                   $datesArray[] = substr($userAttendance->attendancedate, -2);
                   
                  
                @endphp

               
                     
                @endforeach
     

          
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
                        labels:[1,2,3],
                        datasets: [{
                            label: 'Daily Attendancee Count',
                            data: [1,2,3], // Make sure this is a valid array
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


{{-- <div>
    <p>{{$monthindex}}</p>
    <button type="button" wire:click="decreasemonth" wire:model="monthcount" name="monthcount" class="btn btn-outline-info">sg</button>
        <button type="button" wire:click="increasemonth" wire:model="monthcount" name="monthcount" class="btn btn-outline-info">ff</button>
</div> --}}
