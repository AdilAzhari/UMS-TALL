<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramType extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
    ];
    public function programs()
    {
        return $this->hasMany(Program::class);
    }
}
