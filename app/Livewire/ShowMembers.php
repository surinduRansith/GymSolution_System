<?php

namespace App\Livewire;

use App\Models\Members;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('members')]
class ShowMembers extends Component
{
    public $members;

   
    public function mount()
    {
        $this->members = Members::all();
    }
    public function render()
    {
        return view('livewire.show-members');
    }
}
