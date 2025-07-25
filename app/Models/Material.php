<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $table = 'materials';

    protected $fillable = [
        'course_id',
        'topic',
        'video_url',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
