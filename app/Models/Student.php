<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    protected $table = 'students';

    use HasApiTokens, HasFactory, Notifiable;

    protected $with = ['classroom'];
    protected $fillable = [
        'nik',
        'name',
        'classroom_id',
        'phone',
        'address',
        'photo',
        'password',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getRouteKeyName()
    {
        return 'nik';
    }

    public function Classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
}
