<?php

namespace App\Livewire;

use App\Models\Assignment;
use App\Models\materi;
use Illuminate\Support\Str; // Import class Str untuk memotong string
use App\Models\work;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class ClassContent extends Component
{
    public $queries;
    public $materi;
    public $tugasKuis;
    public $lecture;
    public $tugasTerbaru;
    public $materiTerbaru;
    public $isTentorInThisClass = false;
    public string $newNoticeDescription = '';
    public $activeTab = 'materiTab';
    public $validtabs = ['materiTab', 'forumTab', 'tugasTab'];

    public function active($tabName)
    {
        if (in_array($tabName, $this->validtabs)) {
            $this->activeTab = $tabName;
        }
    }

    // UBAH METHOD storeNotice MENJADI SEPERTI INI
    public function storeNotice()
    {
        // 1. Validasi input tunggal
        $this->validate([
            'newNoticeDescription' => 'required|string|min:5|max:5000',
        ]);

        // 2. Buat notice baru di database
        $this->lecture->notice()->create([
            'lecture_id' => $this->lecture->id,
            // Isi body dengan deskripsi lengkap
            'description' => $this->newNoticeDescription,
        ]);

        // 3. Reset field form agar kosong kembali
        $this->reset(['newNoticeDescription']);

        // 4. Beri notifikasi sukses (tanpa perubahan)
        $this->dispatch('notice-stored', [
            'type' => 'success',
            'title' => 'Berhasil!',
            'text' => 'Diskusi baru telah dipublikasikan.'
        ]);

        Alert::success('Berhasil Membuat Forum', 'Anda berhasil membuat forum baru!');
    }

    public function render()
    {
        Log::info('Nilai queries: ' . $this->queries);
        $user = Auth::user();

        if (!empty(trim($this->queries))) {
            if ($this->activeTab == 'materiTab') {
                $searchWork = materi::where('lecture_id', $this->lecture->id)
                    ->where(function ($query) {
                        $query->where('title', 'LIKE', '%' . $this->queries . '%');
                    })->get();
            } else {
                $searchWork = Assignment::where('lecture_id', $this->lecture->id)
                    ->where(function ($query) {
                        $query->where('title', 'LIKE', '%' . $this->queries . '%');
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

        $pengumuman = $this->lecture->notice()->latest()->get();

        return view('livewire.class-content', compact('searchWork', 'pengumuman'));
    }
}
