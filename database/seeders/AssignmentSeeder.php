<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\work;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Assignment::factory(100)->create();
    }
}
