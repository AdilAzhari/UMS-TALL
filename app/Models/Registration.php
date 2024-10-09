<?php

namespace App\Models;

use Filament\Forms\Components\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Registration extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'course_id',
        'proctor_id',
        'term_id',
        'status',
        'start_date',
        'end_date',
        'proctor_status',
        'payment_status',
    ];
    protected Hidden $status;
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'payment_status' => 'boolean',
    ];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
    public function proctor(): BelongsTo
    {
        return $this->belongsTo(Proctor::class);
    }
    public function term(): BelongsTo
    {
        return $this->belongsTo(Term::class);
    }
    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }
}
