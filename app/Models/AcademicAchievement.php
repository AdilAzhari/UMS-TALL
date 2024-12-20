<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicAchievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'gpa', 'credits_earned', 'honors_awards', 'student_id', 'term_id',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function term()
    {
        return $this->belongsTo(Term::class);
    }
}
