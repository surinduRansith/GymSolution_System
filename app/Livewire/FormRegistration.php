<?php

namespace App\Livewire;
use Livewire\Attributes\Rule;
use App\Models\Members;
use Illuminate\Support\Facades\DB;
use App\Models\Weight;
use Livewire\Component;

class FormRegistration extends Component
{
   #[Rule('required')]
    public $userName;
    #[Rule('required|string|in:male,female')]
    public $gender  ;
    #[Rule('required|date')]
    public $dob;
    #[Rule('required|min:10|max:10')]
    public $mobileNumber;
    #[Rule('required|string|in:Monthly,Annual')]
    public $membershiptype;
    #[Rule('required|integer')]
    public $height;
    #[Rule('required|integer')]
    public $weight;
    #[Rule('required|date')]
    public $startdate;
    #[Rule('required|date')]
    public $enddate;

    public function submit(){

        $this->validate();
        $nextId = DB::table('members')->max('id') + 1;

        Members::create([
                    'name' => $this->userName,
                    'gender'=> $this->gender,
                    'dob'=> $this->dob,
                    'mobile'=> $this->mobileNumber,
                    'membershiptype'=>$this->membershiptype,
                    'height'=>  $this->height,
                    'weight'=>  $this->weight,
                    'startDate'=>$this->startdate,
                    'ExpireDate'=>$this->enddate
                ]);
        
            Weight::create([
                    'member_id'=>$nextId,
                    'weight'=>$this->weight,
                ]);

                $this->reset();

                return redirect()->route('members.data')->with('success', 'Data inserted successfully!');

    }
    public function render()
    {
        return view('livewire.form-registration');
    }
}
