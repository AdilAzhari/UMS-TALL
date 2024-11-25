<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    /** @use HasFactory<\Database\Factories\StoryFactory> */
    use HasFactory;
    protected $fillable = ['title', 'slug', 'content', 'published', 'published_at', 'student_id'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function tags()
    {
        return $this->belongsToMany(StoryTag::class);
    }
    public function comments()
    {
        return $this->hasMany(StoryComment::class);
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function scopePublished($query)
    {
        return $query->where('published', true);
    }
    public function scopeDraft($query)
    {
        return $query->where('published', false);
    }
    public function replies()
    {
        return $this->hasMany(StoryComment::class)->whereNotNull('parent_id');
    }
}
