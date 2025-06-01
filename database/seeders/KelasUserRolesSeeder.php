<?php

namespace Database\Seeders;

use App\Models\KelasUserRoles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasUserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KelasUserRoles::truncate();

        KelasUserRoles::factory(30)->create();
    }
}
