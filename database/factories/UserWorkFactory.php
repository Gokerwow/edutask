<?php

namespace Database\Factories;

use App\Models\Assignment;
use App\Models\User;
use App\Models\work;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\user_work>
 */
class UserWorkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'assignments_id' => Assignment::inRandomOrder()->first()->id,
            'file_path' => fake()->filePath(),
            'status' => fake()->randomElement(['submitted', 'graded', 'late']),
            'grade' => fake()->numberBetween(0, 100),
            'comment' => fake()->sentence(10),
        ];
    }
}
