<?php

namespace App\Livewire;

use App\Models\KelasUserRoles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class SearchClass extends Component
{
    public $queries;


    public function render()
    {
        Log::info('Nilai queries: ' . $this->queries);
        $user = Auth::user();

        // Query dasar untuk KelasUserRoles
        $baseQuery = KelasUserRoles::where('user_id', $user->id)
            ->with([
                // Eager load relasi 'lecture'
                'lecture' => function ($query) {
                    // Untuk setiap 'lecture' yang di-load, hitung jumlah 'members'-nya
                    // Pastikan 'members' adalah nama relasi yang benar di model Lecture Anda
                    $query->withCount('user')
                          ->with('tentor'); // Anda tetap bisa eager load relasi lain dari lecture, seperti tentor
                },
                // 'user' // Relasi user di KelasUserRoles (user yang login), mungkin tidak perlu jika sudah punya $user
            ]);

        if (!empty(trim($this->queries))) {
            $searchLectures = $baseQuery->whereHas('lecture', function ($query) {
                $query->where('name', 'LIKE', '%' . $this->queries . '%')
                      ->orWhereHas('tentor', function ($subQuery) {
                          $subQuery->where('name', 'LIKE', '%' . $this->queries . '%');
                      });
            })->get();
        } else {
            $searchLectures = $baseQuery->get();
        }

        Log::info('Hasil pencarian (' . $this->queries . '): ', $searchLectures->toArray());

        return view('livewire.search-class', compact('searchLectures'));
    }
}
