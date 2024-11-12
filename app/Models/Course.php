<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'credit',
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
    public function program()
    {
        return $this->belongsTo(Program::class);
    }
    public function classes()
    {
        return $this->hasMany(Classe::class);
    }
    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
    public function exam(){
        return $this->hasOne(Exam::class);
    }
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function proctor()
    {
        return $this->belongsTo(Proctor::class);
    }
    public function weeks()
    {
        return $this->hasMany(Week::class);
    }
    public function quizzes()
    {
        return $this->hasMany(Quizze::class);
    }
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function ScopAvailableSeats(Builder $query)
    {
        return $query->where('max_students', '>', 'current_students');
    }
    public function prerequisites()
    {
        return $this->belongsToMany(Course::class, 'course_prerequisites', 'course_id', 'prerequisite_course_id');
    }
    public function courseRequirements()
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
}
