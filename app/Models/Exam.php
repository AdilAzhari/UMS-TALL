<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $fillable = [
        'exam_date',
        'exam_description',
        'exam_duration',
        'exam_rules',
        'passing_score',
        'exam_questions',
        'created_by',
        'updated_by',
        'exam_passing_score',
        'exam_answers'
    ];
    public function class()
    {
        return $this->belongsTo(Classe::class);
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function results()
    {
        return $this->hasMany(ExamResult::class);
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function Terms()
    {
        return $this->belongsTo(Term::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
}
