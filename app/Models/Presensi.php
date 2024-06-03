<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $with = ['student'];
    protected $fillable = ['student_id', 'jam_in', 'jam_out', 'picture_in', 'picture_out', 'location_in', 'location_out'];

    public function Student()
    {
        return $this->belongsTo(Student::class);
    }
}
