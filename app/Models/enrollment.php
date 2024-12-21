<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class enrollment extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'student_id',
        'course_id',
        'term_id',
        'status',
        'enrollment_date',
        'completion_date',
        'grade_points',
        'grade',
    ];
    protected $casts = [
        'enrollment_date' => 'datetime',
        'completion_date' => 'datetime',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    public function term(): BelongsTo
    {
        return $this->belongsTo(term::class);
    }
}
