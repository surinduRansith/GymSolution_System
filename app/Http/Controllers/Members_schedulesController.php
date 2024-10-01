<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Members;
use App\Models\Members_schedules;
use App\Models\schedules_types;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Members_schedulesController extends Controller
{
  
    public function insertSchedule(Request $request,$id){

        $members=Members::all()->where('id',$id)->first();
   
        if (!$members) {
            return redirect()->back()->with('error', 'Member not found.');
        }
        $request->validate( [
            'exerciselist' => 'required',
          
        ]);

        Members_schedules::create([
            'member_id' => $members->id,
            'scheduleType_id' => $request->input('exerciselist'),
        ]);

        return redirect()->route('members.profile', ['id' => $id])->with('success', 'Schedule created successfully.');
    }


    public function getmemberSchedules(Request $request, $id){

        $members=Members::all()->where('id',$id)->first();

       

       


        return redirect()->route('members.profile', ['id' => $id],compact('schedules'));


    }

    public function memberscheduleDelete(Request $request, $id, $scheduleid){
            
        DB::table('members_schedules')
               ->where('member_id', $id)
               ->where('scheduleType_id', $scheduleid)
               ->delete();

               DB::table('schedules')
               ->where('member_id', $id)
               ->where('scheduleType_id', $scheduleid)
               ->delete();
           
           
       
           return redirect()->route('members.profile', ['id' => $id])->with('success', 'User Schedule Delete Success');
           }
}
