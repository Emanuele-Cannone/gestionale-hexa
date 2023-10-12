<?php

namespace App\Policies;

use App\Models\Roster;
use App\Models\User;
use Auth;

class RosterPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return (Auth::check() && $user->hasRole(['Super-Admin', 'Admin', 'Accountant', 'IT', 'Developer']));
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Roster $roster): bool
    {
        dd('sono qui');
        return $user->id == $roster->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Roster $roster): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Roster $roster): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Roster $roster): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Roster $roster): bool
    {
        //
    }
}
