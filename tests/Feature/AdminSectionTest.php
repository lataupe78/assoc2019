<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Section;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
        foreach ($sections as $section) {
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

        $managed_sections = Section::where('id', '>', 6)->get();

        $user->managed_sections()->sync($managed_sections->pluck('id'));

        $this->assertCount(
            count($managed_sections),
            $user->fresh()->managed_sections()->get()
        );

        $response = $this->get('/admin/sections');

        foreach ($managed_sections as $section) {
            $response->assertSee($section->title);
        }

        $unmanaged_sections = Section::whereNotIn('id', $managed_sections->pluck('id'))->get();
        foreach ($unmanaged_sections as $section) {
            $response->assertDontSee($section->title);
        }
    }

    /** @test */
    public function simple_admin_can_edit_sections_he_can_manage()
    {

        //$this->withoutExceptionHandling();

        factory(Section::class, 5)->create();

        $this->actingAs(factory(User::class)->create(['role' => 'admin']));
        $user = Auth()->user();

        $this->assertCount(0, $user->managed_sections()->get());
        $managed_sections = Section::where('id', '>', 3)->get();
        $user->managed_sections()->sync($managed_sections->pluck('id'));
        $this->assertCount(
            count($managed_sections),
            $user->fresh()->managed_sections()->get()
        );

        foreach ($managed_sections as $k => $section) {
            //dump( $k. ': testing update section '.$section->title);
            $response = $this->put('admin/sections/'.$section->id, [
                'title' => 'Edited Section',
            ]);

            $edited_section = Section::find($section->id);
            $this->assertEquals('Edited Section', $edited_section->title);
        }
    }

    /** @test */
    public function simple_admin_cannot_edit_sections_he_dont_manage()
    {
        factory(Section::class, 2)->create();

        $this->actingAs(factory(User::class)->create(['role' => 'admin']));
        $user = Auth()->user();
        $user->managed_sections()->sync(1);

        $unmanaged_section = Section::find(2);
        $response = $this->put('admin/sections/'.$unmanaged_section->id, [
                'title' => 'Edited Section',
        ]);

        $response->assertStatus(403);
        $this->assertNotEquals('Edited Section', $unmanaged_section->title);
    }
}
