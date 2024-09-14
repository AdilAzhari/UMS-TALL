<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'department_id',
        'qualification',
        'experience',
        'specialization',
        'designation',
        'hire_date',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function classes()
    {
        return $this->hasMany(Classe::class);
    }
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
    public function gradedAssignments()
    {
        return $this->hasMany(AssignmentSubmission::class, 'graded_by');
    }
}
