<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'telephon',
        'admin_id',
    ];

    public function admin() {
        return $this->hasMany(Admin::class);
    }
}
