<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id',
        'type',
        'title',
        'description',
        'file',
        'thumbnail',
        'size',
        'path',
        'url',
        'filename',
        'extension',
        'status',
        'original_filename',
        'disk',
        'title',
        'description',
        'created_by',
        'updated_by',
    ];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
