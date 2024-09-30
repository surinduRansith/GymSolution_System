<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Schedules;
use App\Models\schedules_types;
use Illuminate\Http\Request;

class schedules_typesController extends Controller
{

  
    public function storeSchedulesTypes(Request $request){
        $request->validate([
            'nameofschedule' => 'required|max:255',
            'exerciselist' => 'required|array'
        ]);
        $array = $request->exerciselist;
       // dd($array );
        $scheduletypes = new schedules_types;
        $scheduletypes->scheduleName = $request->nameofschedule;
        $scheduletypes->scheduleType_names = json_encode($array);
        $scheduletypes->save();
        return redirect()->route("scheduletype.insert")->with("success","Schedule Add Successfully");
    }
}
