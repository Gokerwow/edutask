<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lecture>
 */
class LectureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        do {
            $kode = 'EDU' . strtoupper(Str::random(4)); // contoh: EDU1A2B
        } while (\App\Models\Lecture::where('code', $kode)->exists());

        return [
            'name' => fake()->sentence(2),
            'status' => fake()->randomElement(['active', 'inactive']),
            'code' => $kode,
            'user_id' => User::inRandomOrder()->first()->id,
            'banner' => fake()->randomElement(['images/banners/banner1.jpg', 'images/banners/banner2.jpg', 'images/banners/banner3.jpg', 'images/banners/banner4.jpg'])
        ];
    }
}
