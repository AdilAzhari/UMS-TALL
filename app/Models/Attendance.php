<?php

namespace App\Models;

use App\Enums\AttendanceReason;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory, HasFactory;

    protected $fillable = [
        'enrollment_id',
        'class_group_id',
        'student_id',
        'teacher_id',
        'date',
        'status',
        'reason',
        'notes',
    ];

    protected $attributes = [
        'status' => 'present',
        'reason' => AttendanceReason::SICK,
    ];

    protected $casts = [
        'date' => 'datetime',
        'reason' => AttendanceReason::class,
    ];

    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function classGroup(): BelongsTo
    {
        return $this->belongsTo(ClassGroup::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }
}
