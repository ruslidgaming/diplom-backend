<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;

    protected $fillable = [
        'money',
        'course',
        'lesson',
        'mentor',
        'student',
        'admin_id',
    ];

    public function admin() {
        return $this->hasMany(Admin::class);
    }
}
