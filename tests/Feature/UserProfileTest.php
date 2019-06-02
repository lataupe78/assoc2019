<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserProfileTest extends TestCase
{
    use RefreshDatabase;

    private function datas()
    {
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
        $this->call('GET', route('users.profile.show', ['user' => $member]))
        ->assertStatus(200)
        ->assertSee($member->name);
    }

    /** @test */
    public function a_guest_can_not_update_profile_page_of_a_user()
    {
        //$this->withExceptionHandling();
        $member = factory(User::class)->create();
        $this->call('PUT', route('users.profile.update', ['user' => $member]),
            $this->datas()
        )->assertStatus(302)
        ->assertRedirect('/login');
    }

    /** @test */
    public function a_user_can_see_update_profile_action_on_his_own_profile()
    {
        $this->withoutExceptionHandling();

        $member = factory(User::class)->create();
        $this->actingAs($member);

        $response = $this->call('GET', route('users.profile.show', ['user' => $member]));

        $response->assertStatus(200);
        $response->assertSee('Editer le profil');
    }

    /** @test */
    public function a_user_can_edit_his_own_profile()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();

        $this->call('PUT', route('users.profile.update', ['user' => $user]),
            $this->datas()
        );

        $user = User::find($user->id)->fresh();

        $this->assertEquals('TESTVILLE', $user->city);
        $this->assertEquals('TEST STREET', $user->street_address);
        $this->assertEquals('TEST PHONE', $user->phone);
        $this->assertEquals('12345', $user->postcode);
        $this->assertEquals('28/02/1978', $user->birth);
    }
}
