<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $with = ['user'];
    protected $fillable = ['name', 'user_id'];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
