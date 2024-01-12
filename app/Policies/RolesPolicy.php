<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RolesPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin)
{
    $roleNames = $admin->roles->pluck('name')->toArray();
    // dd($roleNames);
    return (in_array('Admin', $roleNames));
}

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Roles $roles)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin)
    {
        $roleNames = $admin->roles->pluck('name')->toArray();
        // dd($roleNames);
        return (in_array('Admin', $roleNames));
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, Roles $roles)
    {
        $roleNames = $admin->roles->pluck('name')->toArray();
        // dd($roleNames);
        return (in_array('Admin', $roleNames));
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, Roles $roles)
    {
        $roleNames = $admin->roles->pluck('name')->toArray();
        // dd($roleNames);
        return (in_array('Admin', $roleNames));
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Roles $roles)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Roles $roles)
    {
        //
    }
}
