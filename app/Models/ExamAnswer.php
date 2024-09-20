<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamAnswer extends Model
{
    use HasFactory;
    protected $fillable = [
        'exam_id',
        'Exam_question_id',
        'answer',
        'status',
        'created_by',
        'updated_by',
    ];
}
