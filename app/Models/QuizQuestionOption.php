<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizQuestionOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_question_id',
        'option',
        'is_correct',
        'created_by',
        'updated_by',
    ];

    public function quizQuestion(): BelongsTo
    {
        return $this->belongsTo(QuizzeQuestion::class);
    }
}
