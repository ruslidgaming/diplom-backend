<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        // 'video',
        // 'image',
        'content',
        'course_id',
    ];

    public function course() {
        return $this->hasMany(Course::class);
    }

    public function progress() {
        return $this->belongsTo(Progress::class);
    }
}
