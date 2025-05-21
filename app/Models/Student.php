<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'oldname',
        'telephon',
        'email',
        'admin_id',
    ];

    public function admin() {
        return $this->hasMany(Admin::class);
    }

    public function progress() {
        return $this->belongsTo(Progress::class);
    }
}
