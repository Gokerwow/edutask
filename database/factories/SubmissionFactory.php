<?php

namespace Database\Factories;

use App\Models\Assignment;
use App\Models\KelasUserRoles;
use App\Models\Submission;
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

        // Loop untuk menemukan kombinasi user dan assignment yang unik
        while (true) {
            $siswaRole = KelasUserRoles::where('role', 'siswa')->inRandomOrder()->first();

            if ($siswaRole) {
                $assignment = Assignment::where('lecture_id', $siswaRole->lecture_id)->inRandomOrder()->first();

                if ($assignment) {
                    $submissionExists = Submission::where('assignment_id', $assignment->id)
                        ->where('user_id', $siswaRole->user_id)
                        ->exists();

                    if (!$submissionExists) {
                        // ======================================================
                        // AWAL DARI PERBAIKAN
                        // ======================================================

                        // 1. Tentukan status terlebih dahulu secara acak.
                        $status = fake()->randomElement(['submitted', 'graded', 'cancelled']);

                        // 2. Siapkan variabel grade dan data terkait dengan nilai default null.
                        $comment = null;
                        $graded_at = null;

                        // 3. Logika kondisional: Isi nilai HANYA jika statusnya 'graded'.
                        //    Ini membuat data Anda lebih logis dan konsisten.
                        if ($status === 'graded') {
                            $grade = fake()->numberBetween(70, 100);
                            $comment = fake()->sentence();
                            $graded_at = fake()->dateTimeThisMonth();
                        }

                        // Untuk status 'submitted' dan 'cancelled', semua variabel di atas akan tetap null.

                        $fakeFileName = fake()->words(3, true) . '.pdf';
                        $fakeFile = UploadedFile::fake()->create($fakeFileName, 1500, 'application/pdf');
                        $filePath = $fakeFile->store('submission_files', 'public');

                        return [
                            'description' => fake()->sentence(),
                            'file_path' => $filePath,
                            'original_fileName' => $fakeFileName,
                            'status' => $status, // Gunakan status yang sudah kita buat
                            'assignment_id' => $assignment->id,
                            'user_id' => $siswaRole->user_id,
                            'grade' => 0, // Gunakan grade yang sudah kita tentukan
                            'comment' => $comment, // Gunakan comment yang sudah kita tentukan
                            'graded_at' => $graded_at, // Gunakan tanggal yang sudah kita tentukan
                        ];
                        // ======================================================
                        // AKHIR DARI PERBAIKAN
                        // ======================================================
                    }
                }
            }
        }
    }
}
