<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Members;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;




class AttendanceController extends Controller
{

  public function showAttendancePage(){

    $dates = [];

    // Get the current month and year
    $currentMonth = Carbon::now()->month;
    $currentYear = Carbon::now()->year;

    // Loop through each day of the current month
    for ($day = 1; $day <= Carbon::now()->daysInMonth; $day++) {
        $dates[] = Carbon::create($currentYear, $currentMonth, $day);
    }
    return view('attendance', compact('dates'));
  }


  public function show(Request $request,$id){

    $attendances = Attendance::all()->where('member_id',$id);

    $attendancedateArray=[];

    foreach($attendances as $attendance){
        $attendancedateArray[] = $attendance->attendancedate;

    }

  $members = Members::all()->where('id',$id);

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
        $monthindex=Carbon::now()->month-1;
        
        if($request->input('monthcount')=='add'){
            $monthindex=$request->input('month');



            $monthindex++;

            if ($monthindex >= count($monthsnames)) {
                $monthindex = 0; // Wrap around to January
            }

        }
        if($request->input('monthcount')=='min'){
            $monthindex=$request->input('month');



            $monthindex--;

            if ($monthindex < 0) {
                $monthindex = 0; // Wrap around to January
            }

        }
         //dd($request->input('month'),$request->input('monthname'));
         return view('attendance', compact('months', 'year','members','attendances','monthindex','monthsnames'));
    }


    public function markAttendance(Request $request, $id){

        $validated = $request->validate([
            "attendance"=>'required',
            "attendancedate"=>'required'
            
        ]);

        Attendance::create([

            'member_id'=>$id,
            'attendancedate'=>$validated['attendancedate'],
            'attendance'=> $validated['attendance'],

           ]
           );

        return redirect()->route('attendance.show',$id)->with('success', 'User Attendance Update Success');
    }


}

