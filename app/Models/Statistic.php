<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'course_id',
        'price'
    ];

    public function student() {
        return $this->hasMany(Student::class);
    }

    public function course() {
        return $this->hasMany(Course::class);
    }
}
