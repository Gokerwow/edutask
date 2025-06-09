<?php

namespace Database\Factories;

use App\Models\Assignment;
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
        Storage::fake('public');

        $fakeFileName = fake()->words(3, true) . '.pdf'; // Contoh: 'aut-sed-et.pdf'
        $fakeFile = UploadedFile::fake()->create($fakeFileName, 1500, 'application/pdf'); // Buat file PDF palsu 1.5MB

        $filePath = $fakeFile->store('submission_files', 'public');

        return [
            'description' => fake()->sentence(),
            'file_path' => $filePath,
            'original_fileName' => $fakeFileName,
            'status' => fake()->randomElement(['submitted', 'graded', 'cancelled']), // Default status
            'assignment_id' => Assignment::inRandomOrder()->first()->id, // Randomly associate with an existing assignment
            'user_id' => User::inRandomOrder()->first()->id, // Randomly associate with an existing user
            'grade' => fake()->numberBetween(0, 100), // Uncomment if you want to include grade
            'comment' => fake()->sentence(5), // Uncomment if you want to include comment
            'graded_at' => fake()->dateTimeBetween('-1 month', 'now'), // Optional field for when the submission was graded
        ];
    }
}
