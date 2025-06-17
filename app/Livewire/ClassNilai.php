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
    public $queries;

    public function render()
    {
        // Untuk highest dan lowest grade, tetap menggunakan grade yang ada saja (bukan null)
        $highestGrade = Submission::whereHas('assignment', function ($query) {
            $query->where('lecture_id', $this->lecture->id);
        })
            ->whereNotNull('grade') // Tambahkan ini untuk mengecualikan grade null
            ->orderBy('grade', 'desc')
            ->first();

        $lowestGrade = Submission::whereHas('assignment', function ($query) {
            $query->where('lecture_id', $this->lecture->id);
        })
            ->whereNotNull('grade') // Tambahkan ini untuk mengecualikan grade null
            ->orderBy('grade', 'asc')
            ->first();

        // Untuk rata-rata keseluruhan, gunakan COALESCE untuk mengganti null dengan 0
        $average = Submission::whereHas('assignment', function ($query) {
            $query->where('lecture_id', $this->lecture->id);
        })
            ->selectRaw('AVG(COALESCE(grade, 0)) as avg_grade')
            ->value('avg_grade');

        $avg_grade_formatted = number_format($average ?? 0, 2);

        // 1. Ambil SEMUA tugas yang relevan untuk mata pelajaran ini
        $allAssignmentsForLecture = Assignment::where('lecture_id', $this->lecture->id)->get();

        // 2. Ambil SEMUA submission yang relevan, tetap gunakan COALESCE
        $allSubmissionsForLecture = Submission::whereIn('assignment_id', $allAssignmentsForLecture->pluck('id'))
            ->with('user')
            ->whereNot('status', 'cancelled')
            ->selectRaw('*, COALESCE(grade, 0) as grade_with_zero') // Kolom baru untuk grade dengan 0
            ->get();

        // 3. Kelompokkan submission berdasarkan user_id
        $gradesPerUser = $allSubmissionsForLecture->groupBy('user_id')->map(function ($userSubmissions, $userId) use ($allAssignmentsForLecture) {

            $user = $userSubmissions->first()->user;

            // Hitung rata-rata menggunakan grade_with_zero (null sudah jadi 0)
            $avg_grade = $userSubmissions->avg('grade_with_zero');
            $letter_grade = $this->letterGrade($avg_grade);

            return (object) [
                'user_id' => $userId,
                'user_name' => $user->name,
                'user_email' => $user->email,
                'user_avatar' => $user->avatar,
                'average_grade' => number_format($avg_grade ?? 0, 2),
                'letter_grade' => $letter_grade,
                'user' => $user,
                'assignments' => $allAssignmentsForLecture,
            ];
        });

        // Salin semua data ke variabel baru.
        $finalGrades = $gradesPerUser;

        // Jika ada input pencarian, filter collection '$finalGrades'.
        if (!empty($this->queries)) {
            $finalGrades = $finalGrades->filter(function ($item) {
                // 'stripos' digunakan untuk pencarian case-insensitive (seperti LIKE)
                return stripos($item->user_name, $this->queries) !== false ||
                    stripos($item->user_email, $this->queries) !== false;
            });
        }

        return view('livewire.class-nilai', [
            'gradesPerUser' => $gradesPerUser,
            'highestGrade' => $highestGrade,
            'lowestGrade' => $lowestGrade,
            'avg_grade' => $avg_grade_formatted,
            'finalGrades' => $finalGrades
        ]);
    }

    public function letterGrade($grade)
    {
        if ($grade >= 85) {
            return 'A';
        } elseif ($grade >= 75 && $grade <= 84) {
            return 'B';
        } elseif ($grade >= 50 && $grade <= 74) {
            return 'C';
        } elseif ($grade >= 45 && $grade <= 59) {
            return 'D';
        } elseif ($grade <= 45) {
            return 'E';
        }
    }
}
