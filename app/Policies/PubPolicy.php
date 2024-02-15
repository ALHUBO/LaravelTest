<?php

namespace App\Policies;

use App\Models\Pub;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PubPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Pub $pub): bool
    {
        //
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
    public function update(User $user, Pub $pub): bool
    {
        return $user->is($pub->user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Pub $pub): bool
    {
        //return $user->is($pub->user);
		// o la logica igual que update
		return $this->update($user,$pub);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Pub $pub): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Pub $pub): bool
    {
        //
    }
}
