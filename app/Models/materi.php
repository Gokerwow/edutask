<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

    protected function formattedFileSize(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->file_path && Storage::disk('public')->exists($this->file_path)) {
                    $bytes = Storage::disk('public')->size($this->file_path);

                    // Logika formatBytes di sini...
                    if ($bytes == 0) return '0 Bytes';
                    $k = 1024;
                    $dm = 2;
                    $sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
                    $i = floor(log($bytes, $k));
                    return round($bytes / pow($k, $i), $dm) . ' ' . $sizes[$i];
                }
                return 'N/A';
            }
        );
    }
}
