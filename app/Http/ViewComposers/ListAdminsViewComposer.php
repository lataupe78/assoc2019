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
            ->select('name', 'slug', 'email', 'id', 'role')
            ->with([
                'managed_sections' => function ($q) {
                    $q->select('id', 'title', 'slug');
                },
            ])
            ->get()
        );
    }
}
