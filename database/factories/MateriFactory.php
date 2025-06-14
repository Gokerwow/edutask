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
        // Pastikan direktori ada saat seeding
        Storage::disk('public')->makeDirectory('materi_files');

        $fakeFileName = fake()->words(3, true) . '.pdf';
        // Buat file PDF palsu 1.5MB
        $fakeFile = UploadedFile::fake()->create($fakeFileName, 1500, 'application/pdf');

        // Simpan file ke storage untuk mendapatkan path yang valid
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
