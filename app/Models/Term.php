<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'slug',
        'max_courses',
        'registration_start_date',
        'registration_end_date',
    ];
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_current' => 'boolean',
    ];
    public function classes()
    {
        return $this->hasMany(Classe::class);
    }
    public function currentStudents()
    {
        return $this->hasMany(Student::class, 'current_term_id');
    }
    public function currentTerm()
    {
        return $this->belongsTo(Term::class, 'term_id');
    }
    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
    public function course(){
        return $this->belongsTo(Course::class);
    }
    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

}
