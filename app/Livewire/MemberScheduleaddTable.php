<?php

namespace App\Livewire;
use App\Models\Members;
use App\Models\Members_schedules;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\Attributes\On; 

class MemberScheduleaddTable extends Component
{
  
  
    public $id;

   
    
  #[on('updateTable')]
  
    public function render()
    {
        $member = Members::where('id', $this->id)->first(); 

        // Correct assignment of schedules
        $schedules = Members_schedules::join('schedules_types', 'members_schedules.scheduleType_id', '=', 'schedules_types.id')
        ->select('schedules_types.*', 'schedules_types.scheduleName as scheduleName' )
        ->where('members_schedules.member_id', $this->id)
        ->get(); 
        return view('livewire.member-scheduleadd-table', [
            'schedules' => $schedules,
            'member' => $member
        ]);
    }
}
