<?php

namespace App\Models;

use Database\Factories\AssignmentSubmissionFileFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssignmentSubmissionFile extends Model
{
    /** @use HasFactory<AssignmentSubmissionFileFactory> */
    use HasFactory;

    protected $fillable = [
        'assignment_submission_id',
        'file_path',
    ];

    public function assignmentSubmission(): BelongsTo
    {
        return $this->belongsTo(AssignmentSubmission::class);
    }
}
