<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStatuse extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'program_id',
        'status',
    ];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
