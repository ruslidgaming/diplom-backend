<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic2 extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'price'
    ];

    public function admin() {
        return $this->hasMany(Admin::class);
    }
}
