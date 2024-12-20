<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechnicalTeam extends Model
{
    use HasFactory;

    protected $fillable = [
        'role',
        'user_id',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
