<?php

namespace App\Livewire;

use App\Models\Assignment;
use App\Models\KelasUserRoles;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;
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

        // 1. Ambil SEMUA tugas yang relevan untuk mata pelajaran ini SEKALI SAJA.
        $allAssignmentsForLecture = Assignment::where('lecture_id', $this->lecture->id)->get();

        // 2. Ambil SEMUA submission yang relevan dalam satu query, dan eager-load data user.
        $allSubmissionsForLecture = Submission::whereIn('assignment_id', $allAssignmentsForLecture->pluck('id'))
            ->with('user') // Eager load untuk menghindari N+1 query
            ->whereNot('status', 'cancelled')
            ->get();

        // 3. Kelompokkan submission berdasarkan user_id, lalu buat objek data yang lengkap.
        $gradesPerUser = $allSubmissionsForLecture->groupBy('user_id')->map(function ($userSubmissions, $userId) use ($allAssignmentsForLecture) {

            // Ambil data user dari submission pertama (sudah di-eager load)
            $user = $userSubmissions->first()->user;

            // Lakukan semua kalkulasi dari data yang sudah ada di memori
            $avg_grade = $userSubmissions->avg('grade');
            $letter_grade = $this->letterGrade($avg_grade);

            // Buat objek akhir yang akan dikirim ke view
            return (object) [
                // Data untuk kartu ringkasan
                'user_id' => $userId,
                'user_name' => $user->name,
                'user_email' => $user->email,
                'user_avatar' => $user->avatar,
                'average_grade' => number_format($avg_grade ?? 0, 2),
                'letter_grade' => $letter_grade,

                // Data lengkap yang dibutuhkan oleh modal
                'user' => $user,
                'assignments' => $allAssignmentsForLecture,
            ];
        });

        return view('livewire.class-nilai', [
            'gradesPerUser' => $gradesPerUser,
            'highestGrade' => $highestGrade,
            'lowestGrade' => $lowestGrade,
            'avg_grade' => $avg_grade_formatted,
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
