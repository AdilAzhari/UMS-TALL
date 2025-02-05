<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuizQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'question',
        'created_by',
        'updated_by',
    ];

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(QuizAnswer::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(Teacher::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(Teacher::class, 'updated_by');
    }

    public function quizQuestionOptions(): HasMany
    {
        return $this->hasMany(QuizQuestionOption::class);
    }
    public function quizQuestionAnswers(): HasMany
    {
        return $this->hasMany(QuizAnswer::class);
    }
    protected static function boot(): void
    {
        parent::boot();

        // Automatically set created_by when creating a new Quiz Question
        static::creating(function ($QuizQuestion): void {
            $QuizQuestion->created_by = auth()->id(); // Set created_by to the current authenticated user's ID
            $QuizQuestion->updated_by = auth()->id();
        });
        static::updating(function ($QuizQuestion): void {
            $QuizQuestion->updated_by = auth()->id();
        });
    }
}
