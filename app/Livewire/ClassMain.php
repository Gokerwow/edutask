<?php

namespace App\Livewire;

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
        return view('livewire.class-main');
    }
}
