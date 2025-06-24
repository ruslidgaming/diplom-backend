<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class Admin extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'oldname',
        'email',
        'tarif',
        'telephon',
        'password',
        'companyName',
        'companyDescription',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function mentor() {
        return $this->belongsTo(Mentor::class);
    }

    public function feedback() {
        return $this->belongsTo(Feedback::class);
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function statistic2() {
        return $this->belongsTo(Statistic2::class);
    }

    public function statistic() {
        return $this->belongsTo(Statistic::class);
    }

    public function refresh_token() {
        return $this->belongsTo(Refresh_token::class);
    }
}
