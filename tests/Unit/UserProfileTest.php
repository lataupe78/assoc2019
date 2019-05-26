<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_has_a_default_profile_picture()
    {
        $member = factory(User::class)->create();

        $this->assertNotEmpty($member->avatar_picture);
    }
}
