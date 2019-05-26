<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserProfileTest extends TestCase
{
	use RefreshDatabase;


	/** @test */
	public function a_guest_can_view_profile_page_of_a_user()
	{
		$this->withoutExceptionHandling();

		$member = factory(User::class)->create();

		$response = $this->get('/profile/'.$member->name);
		$response->assertStatus(200);
		$response->assertSee($member->name);
	}

	/** @test
	public function a_user_has_a_default_profile_picture(){
		$member = factory(User::class)->create();

		$response = $this->get('/profile/'.$member->name);
		$response->assertStatus(200);
		$response->assertSee($member->name);

	}
	 */
}
