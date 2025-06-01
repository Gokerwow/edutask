<?php

namespace Database\Factories;

use App\Models\Lecture;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\work>
 */
class WorkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(3),
            'deadline' => fake()->dateTimeBetween('+1 day', '+1 month'),
            'lecture_id' => Lecture::inRandomOrder()->first()->id,
            'description' => fake()->sentence(5),
            'type' => fake()->randomElement(['materi', 'tugas','kuis'])
        ];
    }
}
