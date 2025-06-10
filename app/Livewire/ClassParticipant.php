<?php

namespace App\Livewire;

use App\Models\KelasUserRoles;
use Livewire\Component;

class ClassParticipant extends Component
{
    public $lecture;

    public function render()
    {
        $participants = KelasUserRoles::where('lecture_id', $this->lecture->id)
            ->orderBy('role', 'desc')
            ->paginate(20);
        return view('livewire.class-participant', [
            'participants' => $participants
        ]);
    }
}
