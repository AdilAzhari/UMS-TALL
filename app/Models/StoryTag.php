<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoryTag extends Model
{
    /** @use HasFactory<\Database\Factories\StoryTagFactory> */
    use HasFactory;
    protected $fillable = ['name', 'slug', 'count'];
    public function stories()
    {
        return $this->belongsToMany(Story::class);
    }
}
