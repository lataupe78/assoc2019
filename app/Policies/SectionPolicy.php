<?php

namespace App\Policies;

use App\Models\Section;
use App\Models\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class SectionPolicy
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
