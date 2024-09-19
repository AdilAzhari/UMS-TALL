<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'enrollment_date',
        'current_year',
        'user_id',
        'program_id',
        'department_id',
        'current_term_id',
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
        return $this->belongsTo(Term::class, 'current_Term_id');
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
        return $this->belongsToMany(Course::class);
    }
}
