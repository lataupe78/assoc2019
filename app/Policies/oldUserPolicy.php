<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        dump('UserPolicy construct');
    }

    public function update(User $userLogged, User $user)
    {
        //dump('reaching policy');

        if($userLogged->id === $user->id){
            return true;
        }

        if($userLogged->isSuperAdmin() && $user->role != 'superadmin'){
            return true;
        }

        /*
        return $userLogged->isAdmin()
        && in_array($section->id, $userLogged->managed_sections());
        //&& $user->sections->contains('section_id');
        */
        return false;
    }
}
