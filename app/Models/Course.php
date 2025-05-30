<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'mini_description',
        'description',
        'image',
        'slogan',
        'course_info',
        'admin_id',
    ];

    public function admin() {
        return $this->hasMany(Admin::class);
    }

    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }

    public function menourses()
    {
        return $this->hasMany(Menourse::class, 'course_id');
    }

    public function lesson() {
        return $this->belongsTo(Lesson::class);
    }

    public function progress() {
        return $this->belongsTo(Progress::class);
    }

    public function mentors()
    {
        return $this->belongsToMany(Mentor::class, 'menourses', 'course_id', 'mentor_id');
    }
}
