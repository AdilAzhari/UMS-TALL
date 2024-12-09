<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Student extends Model
{
    use HasFactory,Notifiable;
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
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
    public function academicProgress()
    {
        return $this->hasMany(AcademicProgress::class);
    }
    public function academicProgressByTerm($termId)
    {
        return $this->academicProgress()->where('term_id', $termId)->first();
    }
    public function course()
    {
        return $this->belongsToMany(Course::class, 'course_student')
                    ->withPivot('enrolled_date')
                    ->withTimestamps();
    }
    public function courseCategories()
    {
        return $this->courses->pluck('category')->unique('name')->values();
    }
    public function academicAchievements() {
        return $this->hasMany(AcademicAchievement::class);
    }

    public function courseGrades() {
        return $this->hasMany(CourseGrades::class);
    }
    public function terms()
    {
        return $this->hasManyThrough(Term::class, Enrollment::class, 'student_id', 'id', 'id', 'term_id')
                    ->with('courses');
    }

}
