<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoticeComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'user_id',
        'notice_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notice()
    {
        return $this->belongsTo(Notice::class);
    }
}
