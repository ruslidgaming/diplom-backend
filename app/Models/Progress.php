<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'student_id',
        'lesson_id',
        'complete',
    ];

    public function course() {
        return $this->hasMany(Course::class);
    }

    public function student() {
        return $this->hasMany(Student::class);
    }

    public function lesson() {
        return $this->hasMany(Lesson::class);
    }
}
