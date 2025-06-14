<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasRoles, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function kelasRoles()
    {
        return $this->hasMany(KelasUserRoles::class);
    }

    public function roleDikelas($lectureID, $userID) {
        return $this->kelasRoles()
                ->where('user_id', $userID)
                ->where('lecture_id', $lectureID)
                ->first();
    }

    // public function kelasSebagaiTentor()
    // {
    //     return $this->kelasRoles()->where('role', 'tentor');
    // }

    public function tugas() {
        return $this->hasMany(Submission::class);
    }

    public function lecture() {
        return $this->belongsToMany(Lecture::class, 'kelasuserroles', 'user_id', 'lecture_id');
    }

    public function kelasUserRoles()
    {
        return $this->hasMany(KelasUserRoles::class);
    }

    public function submissions()
    {
        return $this->hasmany(Submission::class);
    }
}
