<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class work extends Model
{
    /** @use HasFactory<\Database\Factories\WorkFactory> */
    use HasFactory;

    protected $casts = [
        'deadline' => 'datetime', // Penting agar 'deadline' otomatis menjadi objek Carbon saat diambil dari DB
        // tambahkan cast lain jika ada
    ];

    public function user() {
        return $this->hasMany(userWork::class);
    }

    public function lecture() {
        return $this->belongsTo(Lecture::class);
    }

    protected function sisaWaktu(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                // Periksa apakah atribut 'deadline' ada dan tidak null
                if (!isset($attributes['deadline']) || is_null($attributes['deadline'])) {
                    return 'Deadline tidak ditentukan'; // Atau null, atau pesan lain sesuai kebutuhan
                }

                // Karena ada $casts['deadline' => 'datetime'], $attributes['deadline']
                // mungkin sudah menjadi string format standar atau bahkan objek Carbon
                // tergantung bagaimana Eloquent menanganinya sebelum masuk ke accessor.
                // Carbon::parse() cukup fleksibel untuk menangani ini.
                $parsedDeadline = Carbon::parse($attributes['deadline']);
                $now = Carbon::now(); // Menggunakan timezone default aplikasi (UTC berdasarkan dd() Anda)

                // Jika deadline sudah lewat
                if ($parsedDeadline->isPast()) {
                    return 'Telah Lewat';
                }

                // Jika deadline belum lewat, hitung sisa waktu
                return $parsedDeadline->diffForHumans($now, [ // Tukar posisi $now dan $parsedDeadline
                    'parts' => 2,
                    'short' => false,
                    'join' => ', ',
                    'syntax' => Carbon::DIFF_RELATIVE_TO_NOW
                ]);
            }
        );
    }
}
