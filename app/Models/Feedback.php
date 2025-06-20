<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    /** @use HasFactory<\Database\Factories\FeedbacksFactory> */
    use HasFactory;

    protected $table = 'feedbacks';
    protected $fillable = ['user_id', 'feedback'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
