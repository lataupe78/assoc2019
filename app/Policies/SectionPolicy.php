<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Section;
use Illuminate\Auth\Access\HandlesAuthorization;

class SectionPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }

    public function create(User $user)
    {
        return $user->isSuperAdmin();
    }

    public function update(User $user, Section $section)
    {
        return $user->canManage($section);
    }

    public function delete(User $user, Section $section)
    {
        return $user->isSuperAdmin();
    }

    /**
     * Determine whether the user can restore the section.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Section  $section
     * @return mixed
     */
    public function restore(User $user, Section $section)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the section.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Section  $section
     * @return mixed
     */
    public function forceDelete(User $user, Section $section)
    {
        //
    }
}
