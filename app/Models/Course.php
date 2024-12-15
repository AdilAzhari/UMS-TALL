<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Query\Builder;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'credit_hours',
        'description',
        'syllabus',
        'image',
        'max_students',
        'status',
        'requier_proctor',
        'paid',
        'prerequisite_course_id',
        'course_category_id',
        'cost',
        'teacher_id',
        'program_id',
        'proctor_id',
        'department_id',
        'sequence',
        'term_id',
    ];

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function classes(): HasMany
    {
        return $this->hasMany(Classe::class);
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class);
    }

    public function exams(): HasMany
    {
        return $this->hasMany(Exam::class);
    }

    public function exam(): HasOne
    {
        return $this->hasOne(Exam::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(Teacher::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function proctor(): BelongsTo
    {
        return $this->belongsTo(Proctor::class);
    }

    public function weeks(): HasMany
    {
        return $this->hasMany(Week::class);
    }

    public function quizzes(): HasMany
    {
        return $this->hasMany(Quizze::class);
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function ScopAvailableSeats(Builder $query): Builder
    {
        return $query->where('max_students', '>', 'current_students');
    }

    public function prerequisites(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_prerequisites', 'course_id', 'prerequisite_course_id');
    }

    public function courseRequirements(): HasMany
    {
        return $this->hasMany(CourseRequirement::class);
    }

    public function studentCourses()
    {
        return $this->hasMany(StudentCourse::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopePaid($query)
    {
        return $query->where('is_paid', true);
    }

    public function scopeFree($query)
    {
        return $query->where('is_paid', false);
    }

    public function scopeNotStarted($query)
    {
        return $query->whereDoesntHave('studentCourses', function ($query) {
            $query->where('status', 'not_started');
        });
    }

    public function category()
    {
        return $this->belongsTo(CourseCategory::class, 'course_category_id');
    }

    public function scopeFutureCourses($query)
    {
        return $query->where('status', 'future_payment');
    }

    public function scopeCurrentCourses($query)
    {
        return $query->where('status', 'registered');
    }

    public function scopePastCourses($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    public function scopeRegistered($query)
    {
        return $query->where('status', 'registered');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeFuturePayment($query)
    {
        return $query->where('status', 'future_payment');
    }

    public function scopeCourseRequirements($query)
    {
        return $query->whereHas('courseRequirements');
    }

    public function term(): BelongsTo
    {
        return $this->belongsTo(Term::class);
    }

    public function CourseGrade(): BelongsTo
    {
        return $this->belongsTo(CourseGrades::class);
    }
}
