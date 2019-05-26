<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
	public function show($username) {
		$user = User::where('name', $username)
		->with('managed_sections')
		->firstOrFail();


		return view('front.profile.show', [
			'user' => $user
		]);
	}


	public function edit($username){
		$user = User::where('name', $username)
		->firstOrFail();

		$this->authorize('update', $user);

		return view('front.profile.edit', [
			'user' => $user
		]);
	}
	public function update(UserProfileRequest $request, $username){

		$user = User::where('name', $username)->firstOrFail();

		$data = $request->validated();

		if(isset($data['password'])){
			$data['password'] =  Hash::make($data['password']);
		}

		$user->update($data);

		return redirect()->route('users.profile.show', ['username' => $username]);

	}


}