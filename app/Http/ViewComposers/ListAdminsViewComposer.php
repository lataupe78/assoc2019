<?php

namespace App\Http\ViewComposers;

use App\Models\User;
use Illuminate\Contracts\View\View;

class ListAdminsViewComposer
{
    public function compose(View $view)
    {
        $view->with('list_admins',
            User::whereIn('role', ['admin', 'superadmin'])
                ->with('managed_sections')
                ->get(['name', 'email', 'id', 'role']));
    }
}
