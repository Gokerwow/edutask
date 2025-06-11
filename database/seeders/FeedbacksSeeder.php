<?php

namespace Database\Seeders;

use App\Models\Feedbacks;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeedbacksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Feedbacks::factory(30)->create();
    }
}
