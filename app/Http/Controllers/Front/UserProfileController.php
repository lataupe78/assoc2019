<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
public function show($username) {
	$user = User::where('name', $username)
	->firstOrFail();

	return view('front.profile.show', [
		'user' => $user
	]);
}
}
