<?php

namespace Database\Factories;

use App\Models\Notice;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NoticeComment>
 */
class NoticeCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Mengambil ID notice dan user secara acak
            'notice_id' => Notice::inRandomOrder()->first()->id ?? Notice::factory(),
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'comment' => $this->faker->paragraph(2), // Membuat komentar dengan 2 paragraf
        ];
    }
}
