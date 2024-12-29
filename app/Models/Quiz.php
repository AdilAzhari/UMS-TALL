<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'instructions',
        'duration',
        'passing_score',
        'teacher_id',
        'week_id',
        'class_id',
        'type',
        'status',
        'created_by',
        'updated_by',
        'start_date',
        'end_date',
    ];
    protected $attributes = [
        'type' => 'ungraded',
        'status' => 'draft',
    ];
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function class(): BelongsTo
    {
        return $this->belongsTo(Classes::class);
    }

    public function submissions(): HasMany
    {
        return $this->hasMany(QuizzeSubmission::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function QuizQuestion(): HasMany
    {
        return $this->hasMany(QuizzeQuestion::class);
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class);
    }

    public function QuizSubmission(): HasMany
    {
        return $this->hasMany(QuizzeSubmission::class);
    }

    public function QuizAnswer(): HasMany
    {
        return $this->hasMany(QuizzeAnswer::class);
    }

    public function week(): BelongsTo
    {
        return $this->belongsTo(Week::class);
    }
}
