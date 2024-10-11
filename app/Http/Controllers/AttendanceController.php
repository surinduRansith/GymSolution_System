<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Members;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;




class AttendanceController extends Controller
{

//   public function showAttendancePage(){

//     $dates = [];

//     // Get the current month and year
//     $currentMonth = Carbon::now()->month;
//     $currentYear = Carbon::now()->year;

//     // Loop through each day of the current month
//     for ($day = 1; $day <= Carbon::now()->daysInMonth; $day++) {
//         $dates[] = Carbon::create($currentYear, $currentMonth, $day);
//     }
//     return view('attendance', compact('dates'));
//   }


  public function show(Request $request,$id){


  $members = Members::all()->where('id',$id);
  

         return view('attendance', compact('members'));
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

