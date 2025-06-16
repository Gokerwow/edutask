<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Assignment;
use App\Models\Submission;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class GradeMissingAssignments extends Command
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'assignments:grade-missing';

    /**
     * The console command description.
     * @var string
     */
    protected $description = 'Find assignments past deadline and give 0 to students who did not submit.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking for assignments past deadline...');

        // 1. Cari semua tugas yang deadline-nya sudah lewat & belum pernah diproses
        $assignmentsToProcess = Assignment::where('deadline', '<', Carbon::now())
            ->where('processed_for_missing', false)
            ->with('course.students') // Eager load relasi untuk performa
            ->get();

        if ($assignmentsToProcess->isEmpty()) {
            $this->info('No new assignments to process.');
            return;
        }

        foreach ($assignmentsToProcess as $assignment) {
            $this->info("Processing assignment: {$assignment->title} (ID: {$assignment->id})");

            // 2. Dapatkan semua siswa yang terdaftar di kelas untuk tugas ini
            $enrolledStudents = $assignment->course->students;

            foreach ($enrolledStudents as $student) {
                // 3. Cek apakah siswa ini sudah mengumpulkan tugas
                $hasSubmitted = Submission::where('assignment_id', $assignment->id)
                    ->where('user_id', $student->id)
                    ->exists();

                // 4. Jika belum, buat entri submission dengan nilai 0
                if (!$hasSubmitted) {
                    Submission::create([
                        'assignment_id' => $assignment->id,
                        'user_id' => $student->id,
                        'grade' => 0,
                        'content' => 'Tidak mengumpulkan hingga batas waktu.', // Opsional
                    ]);
                    Log::info("User ID {$student->id} was given a 0 for assignment ID {$assignment->id}.");
                    $this->line("-> Marked user {$student->name} (ID: {$student->id}) with grade 0.");
                }
            }

            // 5. Tandai tugas ini agar tidak diproses lagi di masa depan
            $assignment->processed_for_missing = true;
            $assignment->save();
            $this->info("Finished processing assignment ID: {$assignment->id}. Marked as processed.");
        }

        $this->info('All done.');
        return 0; // Command Success
    }
}
