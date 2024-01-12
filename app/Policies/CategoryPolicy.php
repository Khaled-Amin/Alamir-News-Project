<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin)
    {
        $roleNames = $admin->roles->pluck('name')->toArray();
        return in_array('Admin', $roleNames);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Category $cate, Admin $admin)
    {
        // $roleNames = $admin->roles->pluck('name')->toArray();
        // return in_array('Admin', $roleNames);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin)
    {
        $roleNames = $admin->roles->pluck('name')->toArray();
        return in_array('Admin', $roleNames);
        // return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin)
    {
        $roleNames = $admin->roles->pluck('name')->toArray();
        return in_array('Admin', $roleNames);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Category $cate, Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Category $cate, Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Admin $admin)
    {
        //
    }
}
