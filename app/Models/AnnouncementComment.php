<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AnnouncementComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'announcement_id',
        'user_id',
        'comment',
        'parent_id',
        'commented_by',
    ];

    public function announcement(): BelongsTo
    {
        return $this->belongsTo(Announcement::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(AnnouncementComment::class, 'parent_id');
    }

    public function commentedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'commented_by');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(AnnouncementComment::class, 'parent_id');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(AnnouncementComment::class, 'parent_id');
    }
}
