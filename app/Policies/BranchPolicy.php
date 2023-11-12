<?php

namespace App\Policies;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BranchPolicy
{

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny (User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view (User $user, Branch $branch): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create (User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update (User $user, Branch $branch): bool
    {
        $roles = $user->roles()->pluck('code');
        $authRoles = collect([
            'admin',
            'editor',
            'editor' . '.' . $branch->section_id,
            'editor' . '.' . $branch->section_id . '.' . $branch->id,
        ]);

        return $roles->intersect($authRoles)->count() > 0;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete (User $user, Branch $branch): bool
    {
        $roles = $user->roles()->pluck('code');
        $authRoles = collect([
            'admin',
            'editor',
            'editor' . '.' . $branch->section_id,
            'editor' . '.' . $branch->section_id . '.' . $branch->id,
        ]);

        return $roles->intersect($authRoles)->count() > 0;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore (User $user, Branch $branch): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete (User $user, Branch $branch): bool
    {
        //
    }

}
