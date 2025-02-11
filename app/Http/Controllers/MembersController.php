<?php

namespace App\Http\Controllers;

use App\Models\Members;
use App\Models\Schedules;
use App\Models\Exercise_types;
use App\Models\Members_schedules;
use App\Models\schedules_types;
use App\Models\Weight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class MembersController extends Controller
{

  
  

    // public function createMember(Request   $request ){

        
    //     $nextId = DB::table('members')->max('id') + 1;

    //     $request->validate([
    //         'userName' => 'required|string|max:255',
    //         'gender' => 'required|string|in:male,female',
    //         'dob' => 'required|date',
    //         'mobileNumber' => 'required|min:10|max:10',
    //         'membershiptype' =>'required|string|in:Monthly,Annual', 
    //         'height' =>  'required|integer',
    //         'weight' =>  'required|integer',
    //         'startdate' =>'required|date',
    //         'enddate' =>'required|date',

    //     ]);

        

    //     Members::create([
    //         'name' => $request->userName,
    //         'gender'=> $request->gender,
    //         'dob'=> $request->dob,
    //         'mobile'=> $request->mobileNumber,
    //         'membershiptype'=>$request->membershiptype,
    //         'height'=>  $request->height,
    //         'weight'=>  $request->weight,
    //         'startDate'=>$request->startdate,
    //         'ExpireDate'=>$request->enddate
    //     ]);

    //     Weight::create([
    //         'member_id'=>$nextId,
    //         'weight'=>$request->weight,
    //     ]);


    //     return redirect()->route('members.data')->with('success', 'Data inserted successfully!');
        
    // }



    public function ShowMembers(Request $request ){

       $members =  Members::all();
      
       
     

      

        return view('/members', compact('members'));

    }

    public function ShowMemberDetails(Request $request, $id ){

       
            $members=Members::all()->where('id',$id);
            $scheduleTypes = schedules_types::all();
            $schedules = Members_schedules::join('schedules_types', 'members_schedules.scheduleType_id', '=', 'schedules_types.id')
        ->select('schedules_types.*', 'schedules_types.scheduleName as scheduleName' )->where('members_schedules.member_id', $id)
        ->get();

            $memberWeights = Weight::all()->where('member_id',$id);

            $memberweightlatestUpdate = Weight::where('member_id', $id)->latest('updated_at')->first();
           
            $formattedUpdateDate = $memberweightlatestUpdate
    ? Carbon::parse($memberweightlatestUpdate->updated_at)->toDateString() 
    : null;

    $now = Carbon::now(); // Current date and time
    $formattedDateTime = $now->format('Y-m-d');
         
    $monthName = Carbon::parse($memberweightlatestUpdate->updated_at)->format('F');

    $dateDifference = Carbon::parse($formattedUpdateDate)->diffInDays($now);


            return view('memberprof', compact('members','scheduleTypes','schedules','memberWeights','formattedUpdateDate','dateDifference','monthName'));

    }

    public function EditMember(Request $request, $id ){

        $members=Members::all()->where('id',$id);
      

               

        return view('memberedit', compact('members'));

    }

    public function EditMemberDetails(Request $request, $id ){

        $member = Members::findOrFail($id);
        $memberweight = Weight::findOrFail($id);

          $request->validate([
            'userName' => 'required|string|max:255',
            'gender' => 'required|string|in:male,female',
            'dob' => 'required|date',
            'mobileNumber' => 'required|min:10|max:10',
            'membershiptype' =>'required|string|in:Monthly,Annual', 
            'height' =>  'required|integer',
            'weight' =>  'required|integer',
            'startdate' =>'required|date',
            'enddate' =>'required|date',

        ]);

        $member->name = $request->input('userName');
        $member->gender = $request->input('gender');
        $member->dob = $request->input('dob');
        $member->mobile = $request->input('mobileNumber');
        $member->membershiptype = $request->input('membershiptype');
        $member->height = $request->input('height');
        $member->weight = $request->input('weight');
        $member->startDate = $request->input('startdate');
        $member->ExpireDate = $request->input('enddate');

        Weight::create([
            'member_id'=>$id,
            'weight'=>  $request->weight,
        ]);

     
        $memberweight->save();
        $member->save();

        return redirect(route('members.data'))->with('success','User Update Success');
    }

    public function weightUpdate(Request $request, $id ){
        
        $member = Members::findOrFail($id);
        //dd($member);
        $memberweight = Weight::all()->where('member_id', $id)->first();
        //dd($memberweight);
          $request->validate([
            
            'weightUpdate' =>  'required|integer',

        ]);

    
     
        $member->weight = $request->input('weightUpdate');
        
        Weight::create([
            'member_id'=>$id,
            'weight'=>  $request->weightUpdate,
        ]);

     
        $memberweight->save();
        $member->save();
        return redirect()->route('members.profile', ['id' => $id])->with('success', 'User Weight Update Success');


    }



   
    public function memberscheduleEditpage(Request $request, $id,$scheduleid){

        $schedules = schedules_types::join('members_schedules', 'schedules_types.id', '=', 'members_schedules.scheduleType_id')
        ->select('schedules_types.*', 'schedules_types.scheduleName as scheduleName','members_schedules.*' )
        ->where('members_schedules.member_id', $id)
        ->where('schedules_types.id', $scheduleid)
        ->get();

        $countofexercises = Schedules::where('member_id', $id)
        ->where('scheduleType_id', $scheduleid)
        ->get();
       
       
        return view('memberscheduleedit',compact('schedules','countofexercises'));
    }

    public function deleteMemberDetails($id){

        DB::table('members')
        ->where('id',$id)
        ->delete();

        return redirect()->route('members.data')->with('success', 'User Delete Success');
    }


    
    public function statusUpdate(Request $request, $id) {
        $member = Members::findOrFail($id);
     
        $request->validate([
            'status' => 'required|string|in:active,inactive'
        ]);
    
        $member->status = $request->input('status');
        $member->save();
    
        return redirect()->route('members.profile', ['id' => $id])->with('success', 'User status updated successfully!');
    }

    public function storeSchedule(Request $request, $id,$scheduleid)
    {

        $members=Members::all()->where('id',$id)->first();

        $schedule = schedules_types::all()->where('id', $scheduleid)->first();

        $exercises = json_decode($schedule->scheduleType_names);

        $validate=[];
        foreach ($exercises as $index => $exercise) {
            $validate["exercisename{$index}"] = 'required';  // Validate exercise name
            $validate["noofsets{$index}"] = 'required|integer';  // Validate number of sets
            $validate["nooftime{$index}"] = 'required|integer';  // Validate number of time
        }
    
        // Validate request data based on dynamic rules
        $validatedData = $request->validate($validate);
    
        // Loop through each exercise and create schedule
        foreach ($exercises as $index => $exercise) {
            Schedules::create([
                'member_id' => $members->id,
                'scheduleType_id' => $scheduleid,
                'exercise_name' => $validatedData["exercisename{$index}"],
                'noofsets' => $validatedData["noofsets{$index}"],
                'nooftime' => $validatedData["nooftime{$index}"],
            ]);
        }

      
    
        return redirect()->route('members.profile', ['id' => $members->id])->with('success', 'Schedule updated successfully.');
    }




 
    
}
