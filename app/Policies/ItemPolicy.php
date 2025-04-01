<?php

namespace App\Policies;

use App\Models\Item;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ItemPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Item $item)
    {
        return true;
    }

    public function isAdmin(User $user)
    {
        return $user->role == 'admin'; // Only admin can accsess this
    }


    public function update(User $user, Item $item)
    {
        return $user->role == 'admin';
    }

    public function delete(User $user, Item $item)
    {
        return $user->role == 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Item $item): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Item $item): bool
    {
        return false;
    }
}
