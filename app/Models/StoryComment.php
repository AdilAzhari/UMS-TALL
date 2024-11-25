<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoryComment extends Model
{
    /** @use HasFactory<\Database\Factories\StoryCommentFactory> */
    use HasFactory;
    protected $fillable = ['content', 'story_id', 'student_id', 'parent_id', 'status', 'published_at'];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function story()
    {
        return $this->belongsTo(Story::class);
    }
    public function replies()
    {
        return $this->hasMany(StoryComment::class, 'parent_id');
    }
}
