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

<div>

    @if(session('success'))
<div class="alert alert-success text-center" role="alert">
  {{ session('success') }}
</div>
@endif
   
    @foreach ($months as $month)
    @if ($month['name'] == $monthsnames[$monthindex])
        <div class="container text-center">
            <h2>
                <button type="button" wire:click="decreasemonth"  name="monthcount" class="btn btn-outline-info">
                    <i class="fa-solid fa-angle-right fa-rotate-180"></i>
                </button>
                {{$monthsnames[$monthindex]}} {{ $currentYear }}
                <button type="button" wire:click="increasemonth"  name="monthcount" class="btn btn-outline-info">
                    <i class="fa-solid fa-angle-right"></i>
                </button>
            </h2>
            <br>
            
            <table class="table table-striped">
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
                            @php
                                $formattedDate = $year . '-' . $month['monthname'] . '-' . $date->format('d');
                                $add = '';
                                $modal = 'modal';
                                $msg = false;

                                if (in_array($formattedDate, $month['mark'])) {
                                    $add = 'table-primary';
                                    $msg = true;
                                    $modal = '';
                                } elseif ($formattedDate == $today) {
                                    $add = 'table-success';
                                    $modal = 'modal';
                                    $msg = false;
                                }
                            @endphp

                            <td data-bs-toggle="{{ $modal }}" data-bs-target="#exampleModal{{ $date->format('d') }}" ({{ $date->format('d') }})" class="{{ $add }}">
                                {{ $date->format('d') }}

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $date->format('d') }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Attendance Mark</h1>
                                            </div>
                                            <div class="modal-body">
                                                
                                                    @php
                                                        $isdate =  (string) $year . '-' . (string) $month['monthname'] . '-' . $date->format('d');
                                                       
                                                        

                                                        
                                                    @endphp
                                                   
                                               
                                                       
                                                       
                                                {{$isdate}}
                                               
                                               
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                 
                                                    <button type="button" wire:click="getValue('{{$isdate}}')"  class="btn btn-primary">Mark Attendance</button>
                                           
                                               

                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if ($msg == true)
                                    <i class="fa-duotone fa-solid fa-dumbbell fa-xl" style="--fa-primary-color: #103cea; --fa-secondary-color: #ea1010;"></i>
                                @endif
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
 

   

