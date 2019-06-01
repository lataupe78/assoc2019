<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\UserProfileRequest;

class UserProfileController extends Controller
{
	public function show(User $user)
	{
		$user->load('managed_sections');

		return view('front.profile.show', [
			'user' => $user,
		]);
	}

	public function edit(User $user)
	{
		$this->authorize('update', $user);

		return view('front.profile.edit', [
			'user' => $user,
		]);
	}

	public function update(UserProfileRequest $request, User $user)
	{
		$data = $request->validated();

		if (isset($data['password'])) {
			$data['password'] = Hash::make($data['password']);
		}

		$user->update($data);
		if (isset($data['avatar_file'])) {
			$filename = 'avatar.'.$request->file('avatar_file')->getClientOriginalExtension();

            $user->addMediaFromRequest('avatar_file')
            	//->preservingOriginal()
            	->usingFileName($filename)
                ->toMediaCollection('avatar');
            }

            return redirect()->route('users.profile.edit', ['user' => $user]);
        }
    }
