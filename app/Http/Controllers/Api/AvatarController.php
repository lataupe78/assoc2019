<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
	public function store()
	{
		request()->validate([
			'avatar' => ['required', 'image']
		]);

        //Storage::disk('public')->delete(auth()->user()->getOriginal('avatar_path'));

        /*
        auth()->user()->update([
            'avatar_path' =>

        ]);
       */


      		//$file = $uploadedFile->storeAs($folder, $name.'.'.$uploadedFile->getClientOriginalExtension(), $disk);

        request()->file('avatar')->store('avatars', 'public');

        return response([], 204);
    }
}
