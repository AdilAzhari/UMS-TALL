<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quizze extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'instructions',
        'duration',
        'passing_score',
        'teacher_id',
        'class_id',
        'type',
        'status',
        'created_by',
        'updated_by',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function class()
    {
        return $this->belongsTo(Classes::class);
    }

    public function submissions()
    {
        return $this->hasMany(QuizzeSubmission::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function QuizzeQuestion()
    {
        return $this->hasMany(QuizzeQuestion::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function QuizzeSubmission()
    {
        return $this->hasMany(QuizzeSubmission::class);
    }

    public function QuizzeAnswer()
    {
        return $this->hasMany(QuizzeAnswer::class);
    }
}
