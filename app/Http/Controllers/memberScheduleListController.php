<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Schedules;
use App\Models\Members;
use Illuminate\Http\Request;

class memberScheduleListController extends Controller
{
    public function memberScheduleList($id ){

        $membersName=Members::all()->where('id',$id);

        $member = Schedules::join('members', 'schedules.member_id', '=', 'members.id')
            ->join('exercise_types', 'schedules.scheduleType_id', '=', 'exercise_types.id')
            ->select('schedules.*','members.name as name', 'exercise_types.name as exercise_name','schedules.noofsets','schedules.nooftime' )->where('schedules.member_id', $id)
            ->get();
        $data=[
            'title'=>'Surindu',
            'Memberdetails'=>$membersName,
            'schedules'=> $member

        ];

        $pdf = Pdf::loadView('Pdf.memberschedulelist', $data);
    return $pdf->stream('invoice.pdf');
    }
}
