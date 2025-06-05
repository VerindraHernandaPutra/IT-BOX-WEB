<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'course';

    protected $fillable = [
        'course_name',
        'course_hour',
        'course_price',
        'course_type',
        'description',
        'thumbnail',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($course) {
            if ($course->course_price > 0) {
                $course->course_type = 'premium';
            } else {
                $course->course_type = 'free';
            }
        });

        static::updating(function ($course) {
            if ($course->course_price > 0) {
                $course->course_type = 'premium';
            } else {
                $course->course_type = 'free';
            }
        });
    }

    public function materials(): HasMany
    {
        return $this->hasMany(Material::class);
    }

    public function enrolledUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'course_user');
    }

    public function questions() 
    {
        return $this->hasMany(Question::class);
    }

    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail) {
            return asset('storage/' . $this->thumbnail);
        }

        return asset('storage/thumbnails/default-thumbnail.jpg'); // Default thumbnail jika tidak ada
    }
}
