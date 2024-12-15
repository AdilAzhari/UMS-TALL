<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Student extends Model
{
    use HasFactory, Notifiable;

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function examResults(): HasMany
    {
        return $this->hasMany(ExamResult::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function currentTerm(): BelongsTo
    {
        return $this->belongsTo(Term::class, 'Term_id');
    }

    public function assignmentSubmissions(): HasMany
    {
        return $this->hasMany(AssignmentSubmission::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_student')
            ->withPivot('enrolled_date') // Optional: If you want to access the enrollment date
            ->withTimestamps();
    }

    public function gradingScales(): HasMany
    {
        return $this->hasMany(GradingScale::class);
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    public function academicProgressByTerm($termId)
    {
        return $this->academicProgress()->where('term_id', $termId)->first();
    }

    public function academicProgress(): HasMany
    {
        return $this->hasMany(AcademicProgress::class);
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

    public function academicAchievements(): HasMany
    {
        return $this->hasMany(AcademicAchievement::class);
    }

    public function courseGrades(): HasMany
    {
        return $this->hasMany(CourseGrades::class);
    }

    public function terms()
    {
        return $this->hasManyThrough(Term::class, Enrollment::class, 'student_id', 'id', 'id', 'term_id')
            ->with('courses');
    }

}
