<?php

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\StoryCommentFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoryComment extends Model
{
    /** @use HasFactory<StoryCommentFactory> */
    use HasFactory, softDeletes;

    protected $fillable = ['content', 'story_id', 'student_id',
        'parent_id', 'status', 'published_at'];

    protected $attributes = [
        'status' => 'draft',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function story(): BelongsTo
    {
        return $this->belongsTo(Story::class);
    }

    public function replies(): HasMany
    {
        return $this->hasMany(StoryComment::class, 'parent_id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    protected function publishedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->diffForHumans(),
            set: fn ($value) => Carbon::parse($value),
        );
    }
}
