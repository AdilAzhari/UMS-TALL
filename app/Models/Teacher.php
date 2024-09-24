<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'department_id',
        'program_id',
        'qualification',
        'experience',
        'specialization',
        'designation',
        'hire_date',
        'phone_number',
        'status',
        'created_by',
        'updated_by',
    ];
    protected $casts = [
        'hire_date' => 'datetime',
        'status' => 'boolean',
        'experience' => 'integer',
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
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    public function TechnicalTeam()
    {
        return $this->hasOne(TechnicalTeam::class);
    }
}
