<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UserProfileTest extends TestCase
{
	use RefreshDatabase;

	private function datas(){
		return [
			'city' => 'TESTVILLE',
			'street_address' => 'TEST STREET',
			'phone' => 'TEST PHONE',
			'postcode' => '12345',
			'birth' => '28/02/1978',
		];
	}
	/** @test */
	public function a_guest_can_view_profile_page_of_a_user()
	{
		$this->withExceptionHandling();

		$member = factory(User::class)->create();
		$this->get('/profile/'.$member->name)
		->assertStatus(200)
		->assertSee($member->name);
	}


	/** @test */
	public function a_guest_can_not_update_profile_page_of_a_user()
	{

		$member = factory(User::class)->create();
		$this->put('profile/'.$member->name, $this->datas())
		->assertStatus(302)
        ->assertRedirect('/login');

	}


	/** @test */
	public function a_user_can_see_update_profile_action_on_his_own_profile()
	{
		$this->withoutExceptionHandling();

		$member = factory(User::class)->create();
		$this->actingAs($member);

		$response = $this->get('/profile/'.$member->name);

		$response->assertStatus(200);
		$response->assertSee('Editer le profil');
	}


	/** @test */
	public function a_user_can_edit_his_own_profile()
	{
		$this->withoutExceptionHandling();

		$this->signIn();

        $member= auth()->user();
        $this->put('profile/'.$member->name,
            $this->datas()
        );
        $member = User::find($member->id);
        //dd($member);

		$this->assertEquals('TESTVILLE', $member->city);
		$this->assertEquals('TEST STREET', $member->street_address);
		$this->assertEquals('TEST PHONE', $member->phone);
		$this->assertEquals('12345', $member->postcode);
		$this->assertEquals('28/02/1978', $member->birth->format('d/m/Y'));
	}



}
