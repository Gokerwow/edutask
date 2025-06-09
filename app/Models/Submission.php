<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Submission extends Model
{
    /** @use HasFactory<\Database\Factories\SubmissionFactory> */
    use HasFactory;

    protected $fillable = [
        'description',
        'file_path',
        'original_fileName',
        'status', // 'submitted', 'cancelled', 'graded'
        'assignment_id',
        'user_id', // Assuming submissions are linked to users
        'grade', // Optional field for grade
        'comment', // Optional field for comments
        'graded_at', // Optional field for when the submission was graded
    ];

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
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
