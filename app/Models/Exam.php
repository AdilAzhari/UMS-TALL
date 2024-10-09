<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'exam_date',
        'exam_description',
        'exam_duration',
        'exam_rules',
        'exam_passing_score',
        'created_by',
        'updated_by',
        'class_id',
        'teacher_id',
        'course_id',
        'exam_code'
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
    public function questions()
    {
        return $this->morphToMany(ExamQuestion::class, 'questionable');
    }
}
