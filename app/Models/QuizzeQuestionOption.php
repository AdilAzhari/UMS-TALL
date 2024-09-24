<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizzeQuestionOption extends Model
{
    use HasFactory;
    protected $fillable = [
        'quizze_question_id',
        'option',
        'is_correct',
        'created_by',
        'updated_by',
    ];
    public function quizzeQuestion()
    {
        return $this->belongsTo(QuizzeQuestion::class);
    }
    // public function updatedBy(){
    //     return $this->;
    // }
}
