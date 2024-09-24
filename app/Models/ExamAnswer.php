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
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
    public function question()
    {
        return $this->belongsTo(ExamQuestion::class);
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    public function examResult()
    {
        return $this->hasMany(ExamResult::class);
    }
}
