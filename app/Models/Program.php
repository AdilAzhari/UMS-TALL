<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
    public function students()
    {
        return $this->hasMany(Student::class);
    }
    public function programType()
    {
        return $this->belongsTo(ProgramType::class);
    }
    public function programStatus()
    {
        return $this->belongsTo(ProgramStatuse::class);
    }
    public function createdBy()
    {
        return $this->belongsTo(Teacher::class, 'created_by');
    }
    public function updatedBy()
    {
        return $this->belongsTo(Teacher::class, 'updated_by');
    }

}
