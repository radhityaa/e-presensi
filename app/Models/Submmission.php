<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submmission extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'student_id', 'description', 'status', 'approve', 'approve_by', 'approve_at', 'reject_by', 'reject_at'];
    protected $with = ['student'];
    protected $casts = [
        'approve_at' => 'datetime',
        'reject_at' => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
