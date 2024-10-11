<?php

namespace App\Livewire;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Payments;
use Livewire\Attributes\Layout;


class DashbordLinechart extends Component
{
    public $monthindex; // Start with February (index 2)

    public function mount(){
        $this->monthindex = Carbon::now()->month-1;
    }

    public function increasemonth()
    {
        // Increment month index and loop back to January if it goes over December
        if ($this->monthindex < 11) {
            $this->monthindex++;
        } else {
            $this->monthindex = 0; // Go back to January (index 0)
        }
    }

    public function decreasemonth()
    {
        // Decrement month index and loop back to December if it goes below January
        if ($this->monthindex > 0) {
            $this->monthindex--;
        } else {
            $this->monthindex = 11; // Go back to December (index 11)
        }
    }

    public function render()
    {
        $monthsnames = [
            "January", "February", "March", "April", "May", "June", 
            "July", "August", "September", "October", "November", "December"
        ];

        // Use the current year
        $year = Carbon::now()->year;  
        // $targetmonth = $this->monthindex + 1;
        // echo $targetmonth;
        // Create first and last day of the month based on the updated month index
        $firstDayOfMonth = Carbon::create($year,$this->monthindex + 1 )->startOfMonth()->toDateString();
        $lastDayOfMonth = Carbon::create($year, $this->monthindex + 1)->endOfMonth()->toDateString();
        
        // Fetch attendance data
        $userAttendancecount = DB::table('attendances')
            ->select(DB::raw('MONTH(attendancedate) as month_number, attendancedate, COUNT(id) as daily_count'))
            ->whereBetween('attendancedate', [$firstDayOfMonth, $lastDayOfMonth])
            ->groupBy('attendancedate')
            ->orderBy('attendancedate', 'asc')
            ->get();
        
        return view('livewire.dashbord-linechart', [
            'monthsnames' => $monthsnames,
            'monthindex' => $this->monthindex,
            'firstDayOfMonth' => $firstDayOfMonth,
            'lastDayOfMonth' => $lastDayOfMonth,
            'userAttendancecount' => $userAttendancecount,
        ]);
    }
}