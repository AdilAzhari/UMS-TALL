<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'message',
        'week_id',
        'status',
        'type',
        'audience',
        'title',
        'created_by',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function week(): BelongsTo
    {
        return $this->belongsTo(Week::class);
    }

    public function announcementComment(): HasMany
    {
        return $this->hasMany(AnnouncementComment::class);
    }
}
