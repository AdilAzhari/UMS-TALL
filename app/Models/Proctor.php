<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Proctor extends Model
{
    use HasFactory,Notifiable;
    protected $fillable = [
        'course_id',
        'name',
        'email',
        'phone_number',
        'address',
        'city',
        'country',
        'state',
        'student_id',
    ];
    protected $casts = [
        'status' => 'boolean',
    ];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
