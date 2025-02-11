<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Schedules;
use App\Models\Members;
use Illuminate\Http\Request;

class memberScheduleListController extends Controller
{
    public function memberScheduleList($id ,$scheduleid){

        $membersName=Members::all()->where('id',$id);

        $member = Schedules::join('members', 'schedules.member_id', '=', 'members.id')
            ->join('schedules_types', 'schedules.scheduleType_id', '=', 'schedules_types.id')
            ->select('schedules.*','members.name as name','schedules.noofsets','schedules.nooftime', 'schedules_types.scheduleName as scheduleName' )->where('schedules.member_id', $id)
            ->where('schedules.scheduleType_id', $scheduleid)
            ->get();

          
        $data=[
            'title'=>'Surindu',
            'Memberdetails'=>$membersName,
            'schedules'=> $member

        ];

        $pdf = Pdf::loadView('Pdf.memberschedulelist', $data);
        
    return $pdf->stream('Shcedule.pdf');
    }
}
