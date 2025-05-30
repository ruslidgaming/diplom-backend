<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menourse extends Model
{
    use HasFactory;
    protected $fillable = [
        'mentor_id',
        'course_id',
    ];

    public function mentor() {
        return $this->belongsTo(Mentor::class);
    }

    // Один Menourse принадлежит одному курсу
    public function course() {
        return $this->belongsTo(Course::class);
    }
}
