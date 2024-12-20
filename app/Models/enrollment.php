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
        'term_id',
        'status',
        'enrollment_date',
        'completion_date',
        'grade_points',
        'grade',
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

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function courseRequirement()
    {
        return $this->belongsTo(CourseRequirement::class);
    }

    public function scopePastCourses($query)
    {
        return $query->where('completion_date', '<', now());
    }

    public function term()
    {
        return $this->belongsTo(term::class);
    }
}
