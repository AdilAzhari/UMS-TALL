<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizzeQuestion extends Model
{
    use HasFactory;
    protected $fillable = [
        'quizze_id',
        'question',
        'created_by',
        'updated_by',
    ];
    public function quizze()
    {
        return $this->belongsTo(Quizze::class);
    }
}
