<?php

namespace App\Models;

use App\Enums\AssignmentStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Assignment extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'title',
        'description',
        'file',
        'deadline',
        'total_marks',
        'course_id',
        'created_by',
        'updated_by',
        'submission_start',
        'submission_end',
        'assessment_start',
        'assessment_end',
        'is_visible',
        'grading_type',
        'status',
        'class_group_id',
        'teacher_id',
        'max_attempts',
        'passing_score',
        'instructions',
        'attachment_limit',
        'late_submission_policy',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'deleted_at',
        'updated_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'deadline' => 'datetime',
        'submission_start' => 'datetime',
        'submission_end' => 'datetime',
        'assessment_start' => 'datetime',
        'assessment_end' => 'datetime',
        'is_visible' => 'boolean',
        'total_marks' => 'float',
        'max_attempts' => 'integer',
        'passing_score' => 'float',
        'attachment_limit' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status' => AssignmentStatus::PENDING,
        'is_visible' => true,
        'max_attempts' => 1,
        'attachment_limit' => 1,
        'grading_type' => 'numeric', // numeric, letter, pass_fail
        'late_submission_policy' => 'NotAllowed', // not_allowed, allowed_with_penalty, allowed
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'is_active',
        'submission_status',
    ];

    /**
     * Get the class that the assignment belongs to.
     */
    public function classGroup(): BelongsTo
    {
        return $this->belongsTo(ClassGroup::class)
            ->withDefault(['name' => '']);
    }

    /**
     * Get the teacher that created the assignment.
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    /**
     * Get the user who created the assignment.
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who last updated the assignment.
     */
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Get the course that the assignment belongs to.
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get the week that the assignment belongs to.
     */
    public function week(): BelongsTo
    {
        return $this->belongsTo(Week::class);
    }

    /**
     * Get all submissions for this assignment.
     */
    public function submissions(): HasMany
    {
        return $this->hasMany(AssignmentSubmission::class);
    }

    /**
     * Scope a query to only include visible assignments.
     */
    public function scopeVisible(Builder $query): Builder
    {
        return $query->where('is_visible', true);
    }

    /**
     * Scope a query to only include active assignments.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('submission_end', '>=', now());
    }

    /**
     * Get the active status of the assignment.
     */
    public function getIsActiveAttribute(): bool
    {
        return now()->between($this->submission_start, $this->submission_end);
    }

    /**
     * Get the submission status of the assignment.
     */
    public function getSubmissionStatusAttribute(): string
    {
        if (now() < $this->submission_start) {
            return 'upcoming';
        } elseif (now() > $this->submission_end) {
            return 'closed';
        }

        return 'open';
    }

    /**
     * Check if late submissions are allowed.
     */
    public function allowsLateSubmissions(): bool
    {
        return in_array($this->late_submission_policy, ['allowed', 'allowed_with_penalty']);
    }

    /**
     * Get the file url attribute.
     */
    public function getFileUrlAttribute(): ?string
    {
        return $this->file ? Storage::url($this->file) : null;
    }
}
