<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class enrollment extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'course_id',
        'status',
        'enrollment_date',
        'completion_date'
    ];
    protected $casts = [
        'enrollment_date' => 'datetime',
        'completion_date' => 'datetime',
    ];
    public $timestamps = false;
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
