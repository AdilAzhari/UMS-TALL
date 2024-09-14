<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class enrollment extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'class_id',
        'status',
        'enrollment_date',
    ];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function class()
    {
        return $this->belongsTo(Classe::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
