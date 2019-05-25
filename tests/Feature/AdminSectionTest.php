<?php

namespace Tests\Feature;

use App\Models\Section;
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
	public function admin_users_can_access_admin_dashboard()
	{
		$this->actingAs(factory(User::class)->create(['role' => 'admin']));
		$response = $this->get('/admin');
		$response->assertStatus(200);

	}

	/** @test */
	public function superadmin_can_see_all_sections()
	{
		$this->withoutExceptionHandling();

		$this->actingAs(factory(User::class)->create(['role' => 'superadmin']));

		factory(Section::class, 10)->create();

		$response = $this->get('/admin/sections');

		$sections = Section::all();
		foreach($sections as $section){
			$response->assertSee($section->title);
		}
	}


	/** @test */
	public function simple_admin_can_see_only_see_sections_he_can_manage()
	{
		//$this->withoutExceptionHandling();

		$this->actingAs(factory(User::class)->create(['role' => 'admin']));
		$user = Auth()->user();

		factory(Section::class, 10)->create();

		$this->assertCount(0, $user->managed_sections()->get());

		$managed_sections = Section::where('id' ,'>', 6)->get();

		$user->managed_sections()->sync($managed_sections->pluck('id'));

		$this->assertCount(
			count($managed_sections),
			$user->fresh()->managed_sections()->get()
		);

		$response = $this->get('/admin/sections');

		foreach($managed_sections as $section){
			$response->assertSee($section->title);
		}

		$unmanaged_sections = Section::whereNotIn('id', $managed_sections->pluck('id'))->get();
		foreach($unmanaged_sections as $section){
			$response->assertDontSee($section->title);
		}

	}
}
