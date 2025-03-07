<?php

namespace App\Policies;

use App\Models\ExamQuestionOption;
use App\Models\User;

class ExamQuestionOptionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //r
        return true;

    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ExamQuestionOption $examQuestionOption): bool
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
    public function update(User $user, ExamQuestionOption $examQuestionOption): bool
    {
        //
        return true;

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ExamQuestionOption $examQuestionOption): bool
    {
        //
        return true;

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ExamQuestionOption $examQuestionOption): bool
    {
        //
        return true;

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ExamQuestionOption $examQuestionOption): bool
    {
        //
        return true;

    }
}
