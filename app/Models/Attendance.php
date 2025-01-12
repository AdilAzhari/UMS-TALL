<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory, HasFactory;

    protected $fillable = [
        'enrollment_id',
        'class_group_id',
        'date',
        'status',
        'reason',
        'notes',
    ];

    protected $attributes = [
        'status' => 'present',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function classGroup(): BelongsTo
    {
        return $this->belongsTo(ClassGroup::class);
    }
}
