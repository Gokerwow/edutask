<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class materi extends Model
{
    /** @use HasFactory<\Database\Factories\MateriFactory> */
    use HasFactory;

    protected $table = 'materials';

    protected $fillable = [
        'lecture_id',
        'title',
        'description',
        'file_path',
        'original_fileName',
        'created_at',
        'updated_at',
    ];
    public function lecture()
    {
        return $this->belongsTo(lecture::class);
    }
}
