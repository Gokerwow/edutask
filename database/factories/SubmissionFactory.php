<?php

namespace Database\Factories;

use App\Models\Assignment;
use App\Models\KelasUserRoles;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Submission>
 */
class SubmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        Storage::disk('public')->makeDirectory('submission_files');

        // Loop untuk menemukan kombinasi yang valid
        while (true) {
            // 1. Ambil role siswa secara acak
            $siswaRole = KelasUserRoles::where('role', 'siswa')->inRandomOrder()->first();

            if ($siswaRole) {
                // 2. Ambil tugas yang ada di kelas yang sama dengan siswa tersebut
                $assignment = Assignment::where('lecture_id', $siswaRole->lecture_id)->inRandomOrder()->first();

                if ($assignment) {
                    // 3. Cek apakah siswa ini sudah pernah mengumpulkan tugas ini
                    $submissionExists = Submission::where('assignment_id', $assignment->id)
                        ->where('user_id', $siswaRole->user_id)
                        ->exists();

                    if (!$submissionExists) {
                        // Jika semua kondisi terpenuhi, kita buat data submission
                        $fakeFileName = fake()->words(3, true) . '.pdf';
                        $fakeFile = UploadedFile::fake()->create($fakeFileName, 1500, 'application/pdf');
                        $filePath = $fakeFile->store('submission_files', 'public');

                        return [
                            'description' => fake()->sentence(),
                            'file_path' => $filePath,
                            'original_fileName' => $fakeFileName,
                            'status' => fake()->randomElement(['submitted', 'graded', 'cancelled']),
                            'assignment_id' => $assignment->id,
                            'user_id' => $siswaRole->user_id,
                            'grade' => fake()->optional()->numberBetween(70, 100),
                            'comment' => fake()->optional()->sentence(),
                            'graded_at' => fake()->optional()->dateTimeThisMonth(),
                        ];
                    }
                }
            }
            // Jika tidak ditemukan kombinasi yang valid, loop akan terus berjalan
            // atau Anda bisa menambahkan batas loop untuk menghindari infinite loop jika data tidak memungkinkan
        }
    }
}
