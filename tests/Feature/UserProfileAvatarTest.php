<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserProfileAvatarTest extends TestCase
{
    use RefreshDatabase;

    private function datas()
    {
        return [
            'name' => '',
            'city' => '',
            'street_address' => '',
            'phone' => '',
            'postcode' => '',
            'birth' => '28/02/2018',
        ];
    }

    /** @test */
    public function invalid_avatar_file_is_rejected()
    {
        //$this->withoutExceptionHandling();
        $this->signIn();

        $this->put('profile/'.auth()->user()->name,
            array_merge($this->datas(), ['avatar_file' => 'not_an_image'])
        )->assertSessionHasErrors('avatar_file');
    }

    /** @test */
    public function a_valid_avatar_must_be_provided()
    {
        //$this->withoutExceptionHandling();
        $this->signIn();

        Storage::fake('public');
        $this->put('profile/'.auth()->user()->name,
            [
                'name' => auth()->user()->name,
                'avatar_file' => UploadedFile::fake()->image('avatar-fake.jpg', 256, 256),
            ]);

        //dd($this->app['session.store']);
        //dd(Storage::disk('public')->files());

        Storage::disk('public')->assertExists('/images/avatars/1/avatar.jpg');
    }
}
