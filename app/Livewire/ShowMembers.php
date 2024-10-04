<?php

namespace App\Livewire;

use App\Models\Members;
use Livewire\Component;

class ShowMembers extends Component
{
    public $members;
    public function mount()
    {
        $this->members = Members::all();
    }
    public function render()
    {
        return view('livewire.show-members')->layout('members');
    }
}
