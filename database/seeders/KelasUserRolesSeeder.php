<?php

namespace Database\Seeders;

use App\Models\KelasUserRoles;
use App\Models\Lecture;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasUserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Jumlah siswa yang ingin kita tambahkan ke kelas-kelas.
        // Sesuaikan angka ini jika Anda ingin lebih atau kurang dari 30.
        $jumlahSiswaUntukDibuat = 30;

        // Langkah 1: Ambil semua ID yang relevan dari database.
        $userIds = User::pluck('id');
        $lectureIds = Lecture::pluck('id');

        // Langkah 2: Ambil semua kombinasi (user_id, lecture_id) yang SUDAH ADA.
        // Ini untuk memastikan kita tidak membuat data yang sama.
        $existingRoles = KelasUserRoles::select('user_id', 'lecture_id')
            ->get()
            ->map(function ($role) {
                // Buat kunci unik untuk setiap pasangan, contoh: "5-12"
                return $role->user_id . '-' . $role->lecture_id;
            })
            ->flip(); // `flip` membuat pencarian lebih cepat (O(1) lookup).

        $dataToInsert = [];
        $possibleCombinations = [];

        // Buat semua kemungkinan kombinasi user dan lecture
        foreach ($userIds as $userId) {
            foreach ($lectureIds as $lectureId) {
                $key = $userId . '-' . $lectureId;
                // Jika kombinasi ini BELUM ADA, maka ini adalah kandidat yang valid.
                if (!isset($existingRoles[$key])) {
                    $possibleCombinations[] = [
                        'user_id' => $userId,
                        'lecture_id' => $lectureId,
                    ];
                }
            }
        }

        // Langkah 3: Acak semua kemungkinan kombinasi yang valid.
        shuffle($possibleCombinations);

        // Langkah 4: Ambil sejumlah data yang kita butuhkan dari kombinasi yang sudah diacak.
        $combinationsToCreate = array_slice($possibleCombinations, 0, $jumlahSiswaUntukDibuat);

        // Langkah 5: Siapkan data untuk dimasukkan ke database.
        foreach ($combinationsToCreate as $combo) {
            $dataToInsert[] = [
                'user_id' => $combo['user_id'],
                'lecture_id' => $combo['lecture_id'],
                'role' => 'siswa',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Langkah 6: Masukkan semua data yang sudah pasti unik ke database dalam satu query.
        if (!empty($dataToInsert)) {
            KelasUserRoles::insert($dataToInsert);
        }
    }
}
