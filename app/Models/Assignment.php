<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'file',
        'deadline',
        'total_marks',
        'course_id',
        'created_by',
    ];

    protected $casts = [
        'deadline' => 'datetime',
    ];

    public function class()
    {
        return $this->belongsTo(Classes::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function submissions()
    {
        return $this->hasMany(AssignmentSubmission::class);
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

    public function week()
    {
        return $this->belongsTo(Week::class);
    }
}
