<?php

namespace App\Livewire;

use App\Models\Submission;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ClassNilai extends Component
{
    public $lecture;
    public $tugas;

    public function render()
    {
        // 1. Ambil semua submission seperti yang sudah Anda lakukan
        $submissions = Submission::whereHas('assignment', function($query) {
                $query->where('lecture_id', $this->lecture->id);
            })
            ->with('user') // Eager load user untuk efisiensi
            ->selectRaw('*, COALESCE(grade, 0) as grade') // Tambahkan baris ini
            ->get();

        $highestGrade = Submission::whereHas('assignment', function($query) {
                $query->where('lecture_id', $this->lecture->id);
            })
            ->orderBy('grade', 'desc')
            ->first();

        $lowestGrade = Submission::whereHas('assignment', function($query) {
                $query->where('lecture_id', $this->lecture->id);
            })
            ->orderBy('grade', 'asc')
            ->first();

        // 1. Dapatkan dulu nilai rata-rata dari database
        $average = Submission::whereHas('assignment', function($query) {
                $query->where('lecture_id', $this->lecture->id);
            })
            ->avg('grade');

        // 2. Format angka tersebut menjadi 2 desimal
        // Jika $average adalah NULL (tidak ada nilai), kita ubah jadi 0 dulu
        $avg_grade_formatted = number_format($average ?? 0, 2);

        // 2. Kelompokkan collection berdasarkan user_id
        $gradesPerUser = $submissions->groupBy('user_id')->map(function ($userSubmissions) {
            // Untuk setiap grup (setiap user), buat objek baru yang berisi info
            $avgGrade = $userSubmissions->avg('grade'); // Hitung rata-rata sekali saja
            return (object) [
                'user_name' => $userSubmissions->first()->user->name,
                'user_email' => $userSubmissions->first()->user->email,
                'user_avatar' => $userSubmissions->first()->user->avatar ?? null,
                'grades' => $userSubmissions->pluck('grade'), // Ambil semua nilai
                'average_grade' => number_format($avgGrade ?? 0, 2), // Hitung rata-rata
                'letter_grade' => $this->letterGrade($avgGrade),
                'submission_count' => $userSubmissions->count(), // Hitung jumlah
            ];
        });

        return view('livewire.class-nilai', [
            'gradesPerUser' => $gradesPerUser,
            'highestGrade' => $highestGrade,
            'lowestGrade' => $lowestGrade,
            'avg_grade' => $avg_grade_formatted
        ]);
    }

    public function letterGrade($grade) {
        if ($grade >= 85) {
            return 'A';
        } elseif ($grade >= 75 && $grade <=84 ) {
            return 'B';
        } elseif ($grade >= 50 && $grade <=74 ) {
            return 'C';
        } elseif ($grade >= 45 && $grade <=59 ) {
            return 'D';
        } elseif ($grade <= 45 ) {
            return 'E';
        }
    }
}
