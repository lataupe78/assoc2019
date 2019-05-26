<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserProfileTest extends TestCase
{

	use RefreshDatabase;


	/** @test */
	public function a_user_has_a_default_profile_picture(){
		$member = factory(User::class)->create();

		$this->assertNotEmpty($member->avatar_picture);

	}
}
