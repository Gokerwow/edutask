<?php

namespace Database\Factories;

use App\Models\Lecture;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notice>
 */
class NoticeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Mengambil ID user dan lecture secara acak dari yang sudah ada
            'lecture_id' => Lecture::inRandomOrder()->first()->id ?? Lecture::factory(),
            'description' => $this->faker->paragraph(3), // Membuat isi dengan 3 paragraf
        ];
    }
}
