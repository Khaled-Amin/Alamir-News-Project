<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\Admin;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $user, Article $article)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $user, Article $article)
    {
        // dd($user->id, $article->user_id, $article->id);
        $roleNames = $user->roles->pluck('name')->toArray();
        // dd($roleNames);
        return ($user->id === $article->user_id || in_array('Admin', $roleNames));
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $user, Article $article)
    {
        $roleNames = $user->roles->pluck('name')->toArray();
        // dd($article);
        return ($user->id === $article->user_id || in_array('Admin', $roleNames));
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Admin $user, Article $article)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Admin $user, Article $article)
    {
        $roleNames = $user->roles->pluck('name')->toArray();
        return in_array('Admin', $roleNames);
    }
}
