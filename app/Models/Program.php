<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_code',
        'program_name',
        'description',
        'duration_years',
        'department_id',
        'program_type_id',
        'program_status_id',
        'total_credits',
        'total_courses',
        'created_by',
        'updated_by',
    ];

<<<<<<< HEAD
    public function department()
=======
    public function department(): BelongsTo
>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9
    {
        return $this->belongsTo(Department::class);
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

<<<<<<< HEAD
    public function students()
=======
    public function students(): HasMany
>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9
    {
        return $this->hasMany(Student::class);
    }

<<<<<<< HEAD
    public function programType()
=======
    public function programType(): BelongsTo
>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9
    {
        return $this->belongsTo(ProgramType::class);
    }

<<<<<<< HEAD
    public function programStatus()
=======
    public function programStatus(): BelongsTo
>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9
    {
        return $this->belongsTo(ProgramStatuse::class);
    }

<<<<<<< HEAD
    public function createdBy()
=======
    public function createdBy(): BelongsTo
>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9
    {
        return $this->belongsTo(Teacher::class, 'created_by');
    }

<<<<<<< HEAD
    public function updatedBy()
=======
    public function updatedBy(): BelongsTo
>>>>>>> 8111ea0117bfc51759aa6847977e1354bb2a8eb9
    {
        return $this->belongsTo(Teacher::class, 'updated_by');
    }
}
