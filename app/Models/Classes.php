<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class Classes extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_number',
        'schedule',
        'year',
        'max_students',
        'current_students',
        'course_id',
        'teacher_id',
        'term_id',
    ];

    protected $casts = [
        'max_students' => 'integer',
        'current_students' => 'integer',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function term()
    {
        return $this->belongsTo(Term::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function ScopAvailableSeats(Builder $query)
    {
        return $query->where('max_students', '>', 'current_students');
    }
}
