<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory, HasFactory;

    protected $fillable = [
        'enrollment_id',
        'class_id',
        'date',
        'status',
        'reason',
        'notes',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function class()
    {
        return $this->belongsTo(Classes::class);
    }
}
