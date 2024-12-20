<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseGrades extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'term_id',
        'course_id',
        'grade',
        'credits',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function term()
    {
        return $this->belongsTo(Term::class);
    }
}
