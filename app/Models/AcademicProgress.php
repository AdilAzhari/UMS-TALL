<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AcademicProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'program_id',
        'term_id',
        'gpa',
        'cgpa',
        'progress_percentage',
        'academic_standing',
        'total_credits',
        'total_courses',
        'total_courses_completed',
        'total_courses_failed',
        'total_courses_withdrawn',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function term(): BelongsTo
    {
        return $this->belongsTo(Term::class);
    }

}
