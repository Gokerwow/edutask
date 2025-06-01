<?php

namespace Database\Factories;

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
            'work_id' => work::inRandomOrder()->first()->id,
            'status' => work::inRandomOrder()->first()->id
        ];
    }
}
