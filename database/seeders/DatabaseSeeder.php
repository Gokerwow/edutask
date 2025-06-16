<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\NoticeComment;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            UserSeeder::class,
            LectureSeeder::class,
            AssignmentSeeder::class,
            KelasUserRolesSeeder::class,
            NoticeSeeder::class,
            NoticeCommentSeeder::class,
            MateriSeeder::class,
            SubmissionSeeder::class,
            FeedbacksSeeder::class,
        ]);

    }
}
