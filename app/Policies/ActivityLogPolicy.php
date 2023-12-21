<?php

namespace App\Policies;

use App\Models\ActivityLog;
use App\Models\Users;
use Illuminate\Auth\Access\Response;

class ActivityLogPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Users $users): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Users $users, ActivityLog $activityLog): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Users $users): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Users $users, ActivityLog $activityLog): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Users $users, ActivityLog $activityLog): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Users $users, ActivityLog $activityLog): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Users $users, ActivityLog $activityLog): bool
    {
        //
    }
}
