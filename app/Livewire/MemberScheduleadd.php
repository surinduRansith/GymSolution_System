<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Members;
namespace App\Livewire;
use Livewire\Component;
use App\Models\Members;
use App\Models\schedules_types;
use Illuminate\Validation\Rule;
use App\Models\Members_schedules;

class MemberScheduleadd extends Component
{

    public $id;

    public $exerciselist;

    
   
    
    public function submit(){


      

        $scheduleTypes = schedules_types::all();
        
      
        $schedule_Names = $scheduleTypes->pluck('id')->toArray();
        
        $this->validate( [
            'exerciselist' => [
                'required',
                Rule::in($schedule_Names)
            ],
          
        ]);

 
        if(Members_schedules::where('member_id', $this->id)->where('scheduleType_id', $this->exerciselist)->exists()){
       
       request()->session()->flash('error', 'Schedule Already Exists');
       $this->reset('exerciselist');
        
    }else{
        Members_schedules::create([
            'member_id' => $this->id,
            'scheduleType_id' => $this->exerciselist,
        ]);
        $this->dispatch('updateTable');

        $this->reset('exerciselist');
    }
    }
  

    public function render()
    {
     

        $members = Members::all()->where('id',$this->id);
        $scheduleTypes = schedules_types::all();

       // dd($members);
        // Return the view with both schedules and member passed to it
        return view('livewire.member-scheduleadd', [
            'scheduleTypes' => $scheduleTypes,
            'members' => $members
                    ]) ;
}}
