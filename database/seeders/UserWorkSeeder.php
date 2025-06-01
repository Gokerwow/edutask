<?php

namespace Database\Seeders;

use App\Models\userWork;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserWorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        userWork::factory(30)->create();
    }
}
