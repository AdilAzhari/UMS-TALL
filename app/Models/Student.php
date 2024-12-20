<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Student extends Model
{
<<<<<<< HEAD
    use HasFactory,Notifiable;
=======
    use HasFactory, Notifiable;
>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9

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

<<<<<<< HEAD
    public function examResults()
=======
    public function examResults(): HasMany
>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9
    {
        return $this->hasMany(ExamResult::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

<<<<<<< HEAD
    public function currentTerm()
=======
    public function currentTerm(): BelongsTo
>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9
    {
        return $this->belongsTo(Term::class, 'Term_id');
    }

<<<<<<< HEAD
    public function assignmentSubmissions()
=======
    public function assignmentSubmissions(): HasMany
>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9
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

<<<<<<< HEAD
    public function enrollments()
=======
    public function enrollments(): HasMany
>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9
    {
        return $this->hasMany(Enrollment::class);
    }

<<<<<<< HEAD
    public function registrations()
=======
    public function registrations(): HasMany
>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9
    {
        return $this->hasMany(Registration::class);
    }

<<<<<<< HEAD
    public function academicProgress()
    {
        return $this->hasMany(AcademicProgress::class);
    }

=======
>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9
    public function academicProgressByTerm($termId)
    {
        return $this->academicProgress()->where('term_id', $termId)->first();
    }

<<<<<<< HEAD
=======
    public function academicProgress(): HasMany
    {
        return $this->hasMany(AcademicProgress::class);
    }

>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9
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

<<<<<<< HEAD
    public function academicAchievements()
=======
    public function academicAchievements(): HasMany
>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9
    {
        return $this->hasMany(AcademicAchievement::class);
    }

<<<<<<< HEAD
    public function courseGrades()
=======
    public function courseGrades(): HasMany
>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9
    {
        return $this->hasMany(CourseGrades::class);
    }

    public function terms()
    {
        return $this->hasManyThrough(Term::class, Enrollment::class, 'student_id', 'id', 'id', 'term_id')
            ->with('courses');
    }
}
