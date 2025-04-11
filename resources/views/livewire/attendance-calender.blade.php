@php
    use Illuminate\Support\Carbon;

    $daysArray = ['Sunday','Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    $currentMonthName = Carbon::now()->format('F');
    $currentYear = Carbon::now()->year;
    $currentDate = Carbon::today();
    $formattedDate = $currentDate->format('d');
    $today = $currentDate->format('Y-m-d');
    $monthName = $currentMonthName;
@endphp

<div class="container my-4">

    @if(session('success'))
        <div class="alert alert-success text-center" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @foreach ($months as $month)
        @if ($month['name'] == $monthsnames[$monthindex])
            <div class="card shadow-lg mb-5">
                <div class="card-body">
                    <h2 class="text-center mb-4">
                        <button type="button" wire:click="decreasemonth" name="monthcount" class="btn btn-outline-info me-2">
                            <i class="fa-solid fa-angle-left"></i>
                        </button>
                        {{ $monthsnames[$monthindex] }} {{ $currentYear }}
                        <button type="button" wire:click="increasemonth" name="monthcount" class="btn btn-outline-info ms-2">
                            <i class="fa-solid fa-angle-right"></i>
                        </button>
                    </h2>

                    <div class="table-responsive">
                        <table class="table table-bordered text-center align-middle">
                            <thead class="table-light">
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
                                                $add = 'bg-primary text-white fw-bold';
                                                $msg = true;
                                                $modal = '';
                                            } elseif ($formattedDate == $today) {
                                                $add = 'bg-success text-white fw-bold';
                                                $modal = 'modal';
                                                $msg = false;
                                            }
                                        @endphp

                                        <td class="position-relative {{ $add }}" data-bs-toggle="{{ $modal }}" data-bs-target="#exampleModal{{ $date->format('d') }}">
                                            {{ $date->format('d') }}

                                            {{-- Modal --}}
                                            <div class="modal fade" id="exampleModal{{ $date->format('d') }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-primary text-white">
                                                            <h5 class="modal-title" id="exampleModalLabel">Attendance Mark</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @php
                                                                $isdate = $year . '-' . $month['monthname'] . '-' . $date->format('d');
                                                            @endphp
                                                            <p class="fs-5">{{ $isdate }}</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="button" wire:click="getValue('{{ $isdate }}')" class="btn btn-primary">Mark Attendance</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            @if ($msg)
                                                <i class="fa-solid fa-dumbbell position-center bottom-0 end-0 m-1 text-danger fa-xl"></i>
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
                </div>
            </div>
        @endif
    @endforeach
</div>
