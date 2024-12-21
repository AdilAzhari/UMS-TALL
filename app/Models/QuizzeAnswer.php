<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizzeAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'answer',
        'is_correct',
        'quiz_id',
    ];

    public function question()
    {
        return $this->belongsTo(QuizzeQuestion::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
