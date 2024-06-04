<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qrcode extends Model
{
    use HasFactory;

    protected $fillable = ['qrcode'];
    protected $with = ['student'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
