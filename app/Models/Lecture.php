<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Lecture extends Model
{
    /** @use HasFactory<\Database\Factories\LectureFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'topic',
        'description',
        'code',
        'banner',
        'user_id',
    ];

    // public function siswa() {
    //     return $this->hasMany(KelasUserRoles::class, 'user_id');
    // }

    public function user(): BelongsToMany {
        return $this->belongsToMany(User::class, 'kelasuserroles', 'lecture_id', 'user_id');
    }

    public function tentor() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function assignment() {
        return $this->hasMany(Assignment::class);
    }

    public function materi() {
        return $this->hasMany(materi::class);
    }

    public function notice() {
        return $this->hasMany(Notice::class);
    }

    public function kelasUserRoles()
    {
        return $this->hasMany(KelasUserRoles::class);
    }
}
