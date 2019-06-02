<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Section;
use Illuminate\Auth\Access\HandlesAuthorization;

class oldSectionPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        //dd('reaching Section Policy');

        //dump('reaching Section Policy');
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
}
