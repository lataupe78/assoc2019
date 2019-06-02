<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function each_user_has_a_unique_slug_property()
    {

        //$this->withExceptionHandling();

        $user = factory(User::class)->create([
            'name' => 'Gérard de la Tour',
        ]);

        $this->assertEquals('gerard-de-la-tour', $user->slug);

        $user2 = factory(User::class)->create([
            'name' => 'Gérard de la Tour',
        ]);

        $this->assertEquals('gerard-de-la-tour-1', $user2->slug);

        $user3 = factory(User::class)->create([
            'name' => 'jojo91',
        ]);
        $user4 = factory(User::class)->create([
            'name' => 'jojo91',
        ]);
        $this->assertEquals('jojo91', $user3->slug);
        $this->assertEquals('jojo91-1', $user4->slug);
    }

    /** @test */
    public function a_user_has_a_default_profile_picture()
    {
        $member = factory(User::class)->create();

        $this->assertNotEmpty($member->avatar_picture);
    }
}
