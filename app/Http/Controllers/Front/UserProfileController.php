<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\UserProfileRequest;

class UserProfileController extends Controller
{
    public function show($username)
    {
        $user = User::where('name', $username)
        ->with('managed_sections')
        ->firstOrFail();

        return view('front.profile.show', [
            'user' => $user,
        ]);
    }

    public function edit($username)
    {
        $user = User::where('name', $username)
        ->firstOrFail();

        $this->authorize('update', $user);

        return view('front.profile.edit', [
            'user' => $user,
        ]);
    }

    //public function update($username)
    public function update(UserProfileRequest $request, $username)
    {
        //dd(request());
        $user = User::where('name', $username)->firstOrFail();

        $data = $request->validated();

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        if (isset($data['avatar_file'])) {
            $filename = 'avatar.'.$request->file('avatar_file')->getClientOriginalExtension();

            //dd($filename);

            /*$filename = md5($request->file('avatar_file')->getClientOriginalName()) .
                '.' . $request->file('avatar_file')->getClientOriginalExtension();
            */

            $user->addMediaFromRequest('avatar_file')
            //->usingFileName('avatar')
                ->usingFileName($filename)
                ->toMediaCollection('avatar');
        }

        return redirect()->route('users.profile.show', ['username' => $username]);
    }
}
