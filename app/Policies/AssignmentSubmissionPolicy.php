<?php

namespace App\Policies;

use App\Models\AssignmentSubmission;
use App\Models\User;

class AssignmentSubmissionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, AssignmentSubmission $assignmentSubmission): bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, AssignmentSubmission $assignmentSubmission): bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, AssignmentSubmission $assignmentSubmission): bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, AssignmentSubmission $assignmentSubmission): bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, AssignmentSubmission $assignmentSubmission): bool
    {
        //
        return true;
    }
}
