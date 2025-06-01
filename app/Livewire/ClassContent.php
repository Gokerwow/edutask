<?php

namespace App\Livewire;

use App\Models\work;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ClassContent extends Component
{
    public $queries;
    public $materi;
    public $tugasKuis;
    public $pengumuman;
    public $lecture;
    public $activeTab = 'materiTab';
    public $validtabs = ['materiTab', 'forumTab', 'tugasTab'];

    public function active($tabName) {
        if(in_array($tabName, $this->validtabs)) {
            $this->activeTab = $tabName;
        }
    }

    public function search()
    {
        $user = Auth::user();
    }

    public function render()
    {
        return view('livewire.class-content');
    }
}
