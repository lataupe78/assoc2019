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

	/** @test */
	public function a_user_can_see_update_profile_action_on_his_own_profile(){

		$this->withoutExceptionHandling();

		$member = factory(User::class)->create();
		$this->actingAs($member);

		$response = $this->get('/profile/'.$member->name);

		$response->assertStatus(200);
		$response->assertSee("Editer le profil");


	}


	/** @test */
	public function a_user_can_edit_his_own_profile(){
	//public function a_user_cannot_edit_profile_of_others_users(){

		$this->withoutExceptionHandling();

		$member = factory(User::class)->create();
		//$member1 = factory(User::class)->create();
		//$member2 = factory(User::class)->create();
		//$this->actingAs($member2);

		$this->put('profile/'.$member->name, [
			'city' => 'TESTVILLE',

			'street_address' => 'TEST STREET',
			'phone' => 'TEST PHONE',
            'postcode' => '12345',
            'birth' => '28/02/1978',
			/*
            */
		]);

		//dump($member->fresh());
		//// User::find($member->id)->fresh()
		$member = $member->fresh();
		$this->assertEquals('TESTVILLE', $member->city);
		$this->assertEquals('TEST STREET', $member->street_address);
		$this->assertEquals('TEST PHONE', $member->phone);
		$this->assertEquals('12345', $member->postcode);
		$this->assertEquals('28/02/1978', $member->birth->format('d/m/Y'));
	}
}