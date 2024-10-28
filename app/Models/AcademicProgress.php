<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicProgress extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'program_id',
        'term_id',
        'gpa',
        'cgpa',
        'academic_standing',
        'total_credits',
        'total_courses',
        'total_courses_completed',
        'total_courses_failed',
        'total_courses_withdrawn',
    ];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function program()
    {
        return $this->belongsTo(Program::class);
    }
    public function term()
    {
        return $this->belongsTo(Term::class);
    }
    public function scopeGoodStanding($query)
    {
        return $query->where('academic_standing', 'good');
    }
    public function scopeWarning($query)
    {
        return $query->where('academic_standing', 'warning');
    }
    public function scopeProbation($query)
    {
        return $query->where('academic_standing', 'probation');
    }
    public function scopeSuspension($query)
    {
        return $query->where('academic_standing', 'suspension');
    }
}
