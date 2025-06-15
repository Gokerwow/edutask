<?php

namespace App\Livewire;

use App\Models\KelasUserRoles;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ClassMain extends Component
{
    public $lecture;
    public $tugasTerbaru;
    public $materiTerbaru;
    public $tugas;
    public $materi;
    public $pengumuman;
    public $isTentorInThisClass;
    public $userCount;
    public $activeMainTab = 'dashboard';
    public $validTabs = ['dashboard', 'nilaiTab', 'partisipanTab'];

    public function active($tabName) {
        if (in_array($tabName, $this->validTabs)) {
            $this->activeMainTab = $tabName;
        }
    }
    public function render()
    {
        $isTentor = KelasUserRoles::where('user_id', Auth::id())
        ->where('lecture_id', $this->lecture->id)
        ->where('role', 'tentor')
        ->first();

        return view('livewire.class-main', [
            'isTentor' => $isTentor
        ]);
    }
}
