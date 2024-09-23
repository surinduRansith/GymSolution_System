<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use App\Models\Exercise_types;
use Illuminate\Http\Request;


class ExerciseController extends Controller
{
    public function index(){

        return view("scheduletype");
    }

    public function addtype(Request $request){
        $exerciseTypes = ['Chest Exercises',
'Shoulder Exercises',
'Bicep Exercises',
'Triceps Exercises',
'Leg Exercises',
'Back Exercises',
'Glute Exercises',
'Ab Exercises',
'Calves Exercises',
'Forearm Flexors & Grip Exercises',
'Forearm Extensor Exercises',
'Cardio Exercises & Equipment'
];


$validated=$request->validate( [
            "schedulename"=> "required|max:255",
            'exercisetype' => [
                'required',
                'string',
                Rule::in($exerciseTypes)
            ],
        ]);

        Exercise_types::create(
            [
                "name"=> $validated['schedulename'],
                'exercise_type'=>$validated['exercisetype']
            ]
        );

        return redirect()->route("scheduletype.insert")->with("success","Schedule Add Successfully");

    }

    public function getScheculeType(Request $request){ 

        $scheduleTypes = Exercise_types::all();

        return view("scheduletype", compact("scheduleTypes"));

    }
}
