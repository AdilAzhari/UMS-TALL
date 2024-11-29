<?php

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\StoryFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Story extends Model
{
    /** @use HasFactory<StoryFactory> */
    use HasFactory;

    protected $fillable = ['title', 'slug', 'content', 'published', 'published_at', 'student_id', 'parent_id',
        'status'];

    protected $casts = [
        'published' => 'boolean',
        'status' => 'boolean',
        'parent_id' => 'integer',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(StoryTag::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(StoryComment::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    public function replies(): HasMany
    {
        return $this->hasMany(StoryComment::class)->whereNotNull('parent_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(StoryComment::class, 'parent_id');
    }

    protected function publishedAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::parse($value)->diffForHumans()
        );
    }
}
