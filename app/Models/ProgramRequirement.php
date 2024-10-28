<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramRequirement extends Model
{
    use HasFactory;
    protected $fillable = ['program_id', 'course_category_id', 'required_courses'];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
    public function category()
    {
        return $this->belongsTo(CourseCategory::class);
    }
}
