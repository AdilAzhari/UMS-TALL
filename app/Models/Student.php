<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'enrollment_date',
        'user_id',
        'program_id',
        'student_id',
        'CGPA',
        'department_id',
        'term_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
    public function examResults()
    {
        return $this->hasMany(ExamResult::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function currentTerm()
    {
        return $this->belongsTo(Term::class, 'Term_id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function assignmentSubmissions()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_student')
                    ->withPivot('enrolled_date') // Optional: If you want to access the enrollment date
                    ->withTimestamps();
    }

    public function gradingScales()
    {
        return $this->hasMany(GradingScale::class);
    }
    public function terms()
    {
        return $this->belongsToMany(Term::class);
    }
}
