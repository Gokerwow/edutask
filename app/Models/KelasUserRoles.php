<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasUserRoles extends Model
{
    /** @use HasFactory<\Database\Factories\KelasUserRolesFactory> */
    use HasFactory;

    protected $table = 'kelasUserRoles';

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lecture() {
        return $this->belongsTo(Lecture::class, 'lecture_id');
    }
}
