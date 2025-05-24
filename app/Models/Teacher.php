<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description',
        'course_id',
    ];

    public function course() {
        return $this->hasMany(Course::class);
    }
}
