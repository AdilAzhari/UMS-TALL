<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicProgress extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'gpa',
        'program_id',
        'term_id',
        'total_credits_earned',
        'academic_standing',
        'major_courses_total',
        'major_courses_completed',
        'general_courses_total',
        'general_courses_completed',
        'elective_courses_total',
        'elective_courses_completed',
    ];
    protected function casts(): array
    {
        return [
            'major_courses_total' => 'integer',
            'major_courses_completed' => 'integer',
            'general_courses_total' => 'integer',
            'general_courses_completed' => 'integer',
            'elective_courses_total' => 'integer',
            'elective_courses_completed' => 'integer',
        ];
    }
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
