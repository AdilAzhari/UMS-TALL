<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'status',
        'cost',
        'is_paid',
        'teacher_id',
        'program_id',
        'proctor_id',
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
}
