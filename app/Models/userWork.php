<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userWork extends Model
{
    /** @use HasFactory<\Database\Factories\UserWorkFactory> */
    use HasFactory;

    protected $table = 'submission';

    public function assignment() {
        return $this->belongsTo(Assignment::class);
    }

    public function Siswa() {
        return $this->belongsTo(User::class);
    }
}
