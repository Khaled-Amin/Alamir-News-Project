<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $user)
    {
        $roleNames = $user->roles->pluck('name')->toArray();
        return in_array('Admin', $roleNames);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Comment $comment)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $user)
    {
        $roleNames = $user->roles->pluck('name')->toArray();
        return in_array('Admin', $roleNames);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $user)
    {
        $roleNames = $user->roles->pluck('name')->toArray();
        return in_array('Admin', $roleNames);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $user, Comment $comment)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Comment $comment)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Comment $comment)
    {
        //
    }
}
