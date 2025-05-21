<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refresh_token extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'admin_id',
        'expires_at',
    ];

    public function admin() {
        return $this->hasMany(Admin::class);
    }
}
