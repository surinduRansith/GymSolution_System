<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Weight;
use Illuminate\Http\Request;
use App\Models\Members;

class WeightController extends Controller
{
  
    public function createWeight(Request   $request ){

        $nextId =  session('nextId');

        
        $request->validate([
            'memberid'=>'required,integer',
            'weight' =>  'required|integer',
           

        ]);

        Weight::create([
           
           
            'member_id'=>$nextId,
            'weight'=>  $request->weight,
          
        ]);

        return redirect(route('home'))->back()->with('success', 'Date inserted successfully!');

    }

 
}
