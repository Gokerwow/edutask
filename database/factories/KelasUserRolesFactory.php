<?php

namespace Database\Factories;

use App\Models\Lecture;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\kelas_user_roles>
 */
class KelasUserRolesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Cari kombinasi yang belum ada
        $randomPair = DB::selectOne("
            SELECT u.id AS user_id, l.id AS lecture_id, l.user_id AS lecture_user_id
            FROM users u
            CROSS JOIN lectures l
            LEFT JOIN kelasUserRoles kur ON kur.user_id = u.id AND kur.lecture_id = l.id
            WHERE kur.id IS NULL
            ORDER BY RAND()
            LIMIT 1
        ");

        if (!$randomPair) {
            throw new \RuntimeException("Tidak ditemukan kombinasi user dan lecture yang belum terdaftar.");
        }

        return [
            'user_id' => $randomPair->user_id,
            'lecture_id' => $randomPair->lecture_id,
            'role' => 'siswa',
        ];
    }
}
