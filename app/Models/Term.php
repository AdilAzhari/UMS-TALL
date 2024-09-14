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
        'is_current',
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
}
