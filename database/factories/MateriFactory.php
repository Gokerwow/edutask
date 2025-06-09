<?php

namespace Database\Factories;

use App\Models\Lecture;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\materi>
 */
class MateriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
                // Pilihan 1 (Praktik Terbaik untuk Testing/Seeding Bersih):
        // Gunakan disk palsu agar tidak mengotori direktori storage Anda yang sebenarnya.
        Storage::fake('public');

        // Pilihan 2 (Jika Anda benar-benar ingin file dibuat di storage/app/public):
        // Pastikan direktori tujuan ada
        // Storage::disk('public')->makeDirectory('materi_files');


        // 1. Buat file palsu (fake file)
        // Kita buat nama file yang lebih realistis dan tentukan ukurannya dalam kilobyte.
        $fakeFileName = fake()->words(3, true) . '.pdf'; // Contoh: 'aut-sed-et.pdf'
        $fakeFile = UploadedFile::fake()->create($fakeFileName, 1500, 'application/pdf'); // Buat file PDF palsu 1.5MB

        // 2. Simulasikan penyimpanan file untuk mendapatkan path yang valid
        $filePath = $fakeFile->store('materi_files', 'public');
        return [
            'lecture_id' => Lecture::inRandomOrder()->first()->id,
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'file_path' => $filePath,
            'original_fileName' => $fakeFileName,
        ];
    }
}
