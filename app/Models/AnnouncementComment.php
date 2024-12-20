<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function announcement()
    {
        return $this->belongsTo(Announcement::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(AnnouncementComment::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(AnnouncementComment::class, 'parent_id');
    }

    public function commentedBy()
    {
        return $this->belongsTo(User::class, 'commented_by');
    }
}
