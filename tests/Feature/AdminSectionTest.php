<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminSectionTest extends TestCase
{

	use RefreshDatabase;

	/** @test */
	public function regular_users_cannot_access_admin_dashboard()
	{

		$this->withoutExceptionHandling();

		$this->actingAs(factory(User::class)->create());
		$response = $this->get('/admin');
		$response->assertRedirect('/');

	}


	/** @test */
	public function zdmin_users_can_access_admin_dashboard()
	{
		$this->actingAs(factory(User::class)->create(['role' => 'admin']));
		$response = $this->get('/admin');
        $response->assertStatus(200);

	}
}
