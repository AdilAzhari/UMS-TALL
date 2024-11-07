<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'course_id',
        'status',
    ];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
    public function scopeNotStarted($query)
    {
        return $query->whereDoesntHave('enrollment', function ($query) {
            $query->where('status', 'not_started');
        });
    }
    public function scopeCompleted($query)
    {
        return $query->whereHas('enrollment', function ($query) {
            $query->where('status', 'completed');
        });
    }
}