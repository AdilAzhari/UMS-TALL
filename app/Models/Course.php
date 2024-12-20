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

<<<<<<< HEAD
    public function program()
=======
    public function program(): BelongsTo
>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9
    {
        return $this->belongsTo(Program::class);
    }

<<<<<<< HEAD
    public function classes()
=======
    public function classes(): HasMany
>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9
    {
        return $this->hasMany(Classes::class);
    }

<<<<<<< HEAD
    public function students()
=======
    public function students(): BelongsToMany
>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9
    {
        return $this->belongsToMany(Student::class);
    }

<<<<<<< HEAD
    public function exams()
=======
    public function exams(): HasMany
>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9
    {
        return $this->hasMany(Exam::class);
    }

<<<<<<< HEAD
    public function exam()
=======
    public function exam(): HasOne
>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9
    {
        return $this->hasOne(Exam::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

<<<<<<< HEAD
    public function teachers()
=======
    public function teachers(): BelongsToMany
>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9
    {
        return $this->belongsToMany(Teacher::class);
    }

<<<<<<< HEAD
    public function department()
=======
    public function department(): BelongsTo
>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9
    {
        return $this->belongsTo(Department::class);
    }

<<<<<<< HEAD
    public function proctor()
=======
    public function proctor(): BelongsTo
>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9
    {
        return $this->belongsTo(Proctor::class);
    }

<<<<<<< HEAD
    public function weeks()
=======
    public function weeks(): HasMany
>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9
    {
        return $this->hasMany(Week::class);
    }

<<<<<<< HEAD
    public function quizzes()
=======
    public function quizzes(): HasMany
>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9
    {
        return $this->hasMany(Quizze::class);
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
    public function createdBy()
=======
    public function createdBy(): BelongsTo
>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9
    {
        return $this->belongsTo(User::class, 'created_by');
    }

<<<<<<< HEAD
    public function users()
=======
    public function users(): BelongsToMany
>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9
    {
        return $this->belongsToMany(User::class);
    }

<<<<<<< HEAD
    public function ScopAvailableSeats(Builder $query)
=======
    public function ScopAvailableSeats(Builder $query): Builder
>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9
    {
        return $query->where('max_students', '>', 'current_students');
    }

<<<<<<< HEAD
    public function prerequisites()
=======
    public function prerequisites(): BelongsToMany
>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9
    {
        return $this->belongsToMany(Course::class, 'course_prerequisites', 'course_id', 'prerequisite_course_id');
    }

<<<<<<< HEAD
    public function courseRequirements()
=======
    public function courseRequirements(): HasMany
>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9
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

<<<<<<< HEAD
    public function term()
=======
    public function term(): BelongsTo
>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9
    {
        return $this->belongsTo(Term::class);
    }

<<<<<<< HEAD
    public function CourseGrade()
=======
    public function CourseGrade(): BelongsTo
>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9
    {
        return $this->belongsTo(CourseGrades::class);
    }
}
