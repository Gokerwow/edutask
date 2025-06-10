<?php

namespace App\Livewire;

use App\Models\Assignment;
use App\Models\materi;
use App\Models\work;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ClassContent extends Component
{
    public $queries;
    public $materi;
    public $tugasKuis;
    public $pengumuman;
    public $lecture;
    public $tugasTerbaru;
    public $materiTerbaru;
    public $isTentorInThisClass = false;
    public $activeTab = 'materiTab';
    public $validtabs = ['materiTab', 'forumTab', 'tugasTab'];

    public function active($tabName) {
        if(in_array($tabName, $this->validtabs)) {
            $this->activeTab = $tabName;
        }
    }

    public function render()
    {
        Log::info('Nilai queries: ' . $this->queries);
        $user = Auth::user();

        if (!empty(trim($this->queries))) {
            if ($this->activeTab == 'materiTab') {
                $searchWork = materi::where('lecture_id', $this->lecture->id)
                    ->where(function ($query){
                        $query->where('title', 'LIKE', '%'. $this->queries .'%');
                    })->get();
            } else {
                $searchWork = Assignment::where('lecture_id', $this->lecture->id)
                ->where(function ($query){
                    $query->where('title', 'LIKE', '%'. $this->queries .'%');
                })->get();
            };
        } else {
            if ($this->activeTab == 'materiTab') {
                $searchWork = materi::where('lecture_id', $this->lecture->id)
                ->get();
            } else {
                $searchWork = Assignment::where('lecture_id', $this->lecture->id)
                ->get();
            };
        }

        return view('livewire.class-content', compact('searchWork'));
    }
}
