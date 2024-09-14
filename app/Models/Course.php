<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_name',
        'course_code',
        'course_credit',
        'course_teacher',
        'course_description',
        'course_syllabus',
        'course_image',
        'course_status',
        'requires_proctor',
        'is_paid',
        'cost',
        'program_id',
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
}
