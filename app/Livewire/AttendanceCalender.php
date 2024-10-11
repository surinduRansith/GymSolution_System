<?php

namespace App\Livewire;

use App\Models\Attendance;
use App\Models\Members;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;



#[Layout('attendance')]
class AttendanceCalender extends Component
{

  
    public $id;
    public $members;
     public $monthindex;

     public $monthcount;

     public $month;
     public $monthname;


     public $attendance =1;

    #[Rule('required')]
     public $attendancedate;

    // Property to hold the value from the <p> tag

     public function getValue($isdate ){
         
     
     
       
         $this->attendancedate = $isdate; 

         $this->validate();

         Attendance::create([
 
             'member_id'=>$this->id,
             'attendancedate'=>$this->attendancedate,
             'attendance'=> $this->attendance,
 
            ]
            );
 
            session()->flash('success', 'User Attendance Update Success');
        

         
         
     }
     


    
  
    public function mount($id)
    {
        $this->id = $id; // Assign the passed ID
        $this->members = Members::where('id', $this->id)->get(); // Query based on the ID
        $this->monthindex=Carbon::now()->month-1;
        
        //dd( $this->attendancedate );
    }
 
    
    public function increasemonth(){
        //dd($this->monthindex);
        if($this->monthindex==11){
            $this ->monthindex;
        }else{
        $this->monthindex++;
    }
            }

    public function decreasemonth(){
        //dd($this->monthindex);
        if($this->monthindex==0){
            $this ->monthindex;
        }else{
                $this->monthindex--;
        }
        }

       


        
    public function render()
    {
        

        $dates = [];

    // Get the current month and year
    $currentMonth = Carbon::now()->month;
    $currentYear = Carbon::now()->year;

    // Loop through each day of the current month
    for ($day = 1; $day <= Carbon::now()->daysInMonth; $day++) {
        $dates[] = Carbon::create($currentYear, $currentMonth, $day);
    }


    $attendances = Attendance::all()->where('member_id',$this->id);

    $attendancedateArray=[];

    foreach($attendances as $attendance){
        $attendancedateArray[] = $attendance->attendancedate;

    }

  //$this->members = Members::all()->where('id',$this->id);

         // Get the current year
         $year = Carbon::now()->year;

         // Initialize an array to hold months data
         $months = [];
         
         // Iterate through each month of the year
         for ($month = 1; $month <= 12; $month++) {
             $date = Carbon::create($year, $month, 1);
             $startOfMonth = $date->copy()->startOfMonth();
             $endOfMonth = $date->copy()->endOfMonth();
             $daysArray = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
 
             $dates = [];
             for ($currentDate = $startOfMonth->copy(); $currentDate->lte($endOfMonth); $currentDate->addDay()) {
                 $dates[] = $currentDate->copy();
             }
 
             $months[] = [
                 'name' => $date->format('F'),
                 'monthname' => $date->format('m'),
                 'year' => $year,
                 'daysArray' => $daysArray,
                 'dates' => $dates,
                 'mark'=>$attendancedateArray
             ];
         }

         $monthsnames = [
            "January", "February", "March", "April", "May", "June", 
            "July", "August", "September", "October", "November", "December"
        ];
       
        
       
        
        return view('livewire.attendance-calender', [
            'dates' => $dates,
            'months' => $months,
            'month' => $month,
            'year' => $year,
            'monthindex' => $this->monthindex,
            'monthsnames' => $monthsnames,
            'attendances' => $attendances
        ]);
    }
}
