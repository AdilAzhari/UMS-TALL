<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradingScale extends Model
{
    use HasFactory;
    protected $fillable = [
        'grade',
        'min_score',
        'max_score',
        'student_id ',
        'course_id',
        'gpa_point',
    ];
}