<?php

namespace App\Livewire;

use App\Models\Assignment;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Lecture; // Pastikan ini ditambahkan di atas

class ClassDetailNilai extends Component
{
    public $lecture;
    public $tugas;


    public function render()
    {
        $userId = Auth::id();
        $user = Auth::user();

        $avg_grade = Submission::whereHas('assignment', function ($query) {
            $query->where('lecture_id', $this->lecture->id);
        })
            ->where('user_id', $userId)
            ->avg('grade');

        $assignments = Assignment::where('lecture_id', $this->lecture->id)
            ->with(['submissions' => function ($query) use ($userId) {
                // Filter relasi 'submissions' agar hanya mengambil
                // submission dengan user_id yang sesuai.
                $query->where('user_id', $userId);
            }])
            ->get();


        $assignmentDone = Submission::whereHas('assignment', function ($query) {
            $query->where('lecture_id', $this->lecture->id);
        })
            ->where('user_id', $userId)
            ->whereNot('status', 'cancelled')
            ->count();

        $assignmentTotal = Assignment::where('lecture_id', $this->lecture->id)
            ->count();

        $assignmentNotDone = $assignmentTotal - $assignmentDone;

        $assignmentDonePercent = $this->percentage($assignmentDone, $assignmentTotal);

        $radius = 16;

        $keliling = 2 * M_PI * $radius;

        $strokeOffset = $keliling - ($assignmentDonePercent / 100 * $keliling);

        return view('livewire.class-detail-nilai', [
            'avg_grade' => $avg_grade,
            'user' => $user,
            'assignments' => $assignments,
            'assignmentTotal' => $assignmentTotal,
            'assignmentDone' => $assignmentDone,
            'assignmentDonePercent' => $assignmentDonePercent,
            'assignmentNotDone' => $assignmentNotDone,
            'strokeOffset' => $strokeOffset,
            'keliling' => $keliling
        ]);
    }

    public function percentage($number, $total)
    {
        $percent = $number / $total * 100;
        return $percent;
    }
}
