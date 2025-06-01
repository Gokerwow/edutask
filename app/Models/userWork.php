<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userWork extends Model
{
    /** @use HasFactory<\Database\Factories\UserWorkFactory> */
    use HasFactory;

    protected $table = 'userWorks';

    public function Work() {
        return $this->belongsTo(work::class);
    }

    public function Siswa() {
        return $this->belongsTo(User::class);
    }
}
