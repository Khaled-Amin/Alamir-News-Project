<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SettingPolicy
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
    public function view(Admin $user, Setting $setting)
    {
        // dd($setting);
        $roleNames = $user->roles->pluck('name')->toArray();
        return in_array('Admin', $roleNames);
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
    public function update(Admin $user, Setting $setting)
    {
        $roleNames = $user->roles->pluck('name')->toArray();
        return in_array('Admin', $roleNames);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $user, Setting $setting)
    {
        $roleNames = $user->roles->pluck('name')->toArray();
        return in_array('Admin', $roleNames);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Admin $user, Setting $setting)
    {
        $roleNames = $user->roles->pluck('name')->toArray();
        return in_array('Admin', $roleNames);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Admin $user, Setting $setting)
    {
        $roleNames = $user->roles->pluck('name')->toArray();
        return in_array('Admin', $roleNames);
    }
}
