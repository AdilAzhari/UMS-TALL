<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseRequirement extends Model
{
    use HasFactory;
    protected $fillable = ['course_id', 'course_category', 'required_courses'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function category()
    {
        return $this->belongsTo(CourseCategory::class);
    }
}
