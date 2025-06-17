<?php

namespace App\Livewire;

use App\Models\KelasUserRoles;
use Livewire\Component;

class ClassParticipant extends Component
{
    public $lecture;
    public $queries;

    public function render()
    {
        $baseQuery = KelasUserRoles::where('lecture_id', $this->lecture->id)
            ->with('user');

        if (!empty($this->queries)) {
            $participants = $baseQuery->whereHas('user', function ($query) {
                $query->where('name', 'LIKE', $this->queries . '%')
                    ->orWhere('email', 'LIKE', $this->queries . '%');
            })->paginate(20);
        } else {
            $participants = KelasUserRoles::where('lecture_id', $this->lecture->id)
                ->orderBy('role', 'desc')
                ->paginate(20);
        }

        return view('livewire.class-participant', [
            'participants' => $participants
        ]);
    }
}
