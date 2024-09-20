<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Week extends Model
{
    use HasFactory;
    protected $fillable = [
        'week_number',
        'start_date',
        'end_date',
        'course_id',
    ];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
    public function quizzes()
    {
        return $this->hasMany(Quizze::class);
    }
    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }
}
