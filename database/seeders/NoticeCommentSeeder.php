<?php

namespace Database\Seeders;

use App\Models\NoticeComment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NoticeCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NoticeComment::factory(50)->create();
    }
}
