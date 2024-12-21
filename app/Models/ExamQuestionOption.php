<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamQuestionOption extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'exam_question_id',
        'option',
        'is_correct',
        'created_by',
        'updated_by',
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(ExamQuestion::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
