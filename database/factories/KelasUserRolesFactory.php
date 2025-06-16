<?php

namespace Database\Factories;

use App\Models\KelasUserRoles;
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
        // Loop sampai kita menemukan kombinasi user dan lecture yang unik
        while (true) {
            $user = User::inRandomOrder()->first();
            $lecture = Lecture::inRandomOrder()->first();

            // Cek apakah user sudah terdaftar di kelas ini (sebagai tentor atau siswa)
            $exists = KelasUserRoles::where('user_id', $user->id)
                ->where('lecture_id', $lecture->id)
                ->exists();

            // Jika belum ada, kita bisa gunakan kombinasi ini dan keluar dari loop
            if (!$exists) {
                return [
                    'user_id' => $user->id,
                    'lecture_id' => $lecture->id,
                    'role' => 'siswa', // Factory ini khusus untuk menambahkan siswa
                ];
            }
            // Jika sudah ada, loop akan otomatis berlanjut untuk mencari kombinasi lain
        }
    }
}
