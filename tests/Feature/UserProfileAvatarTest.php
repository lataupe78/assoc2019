<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\Models\Media;
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

    private function dumpStorage($disk = 'public', $path = 'public/images')
    {
        $directories = Storage::disk($disk)->allDirectories($path);
        $files = Storage::disk($disk)->allFiles($path);
        dump($directories);
        dump($files);
    }

    /** @test */
    public function valid_image_file_must_be_provided()
    {
        // $this->withoutExceptionHandling();
        $user = $this->signIn();
        $response = $this->call('PUT', route('users.profile.update', $user), [
        'avatar_file' => 'not_an_image',
    ])->assertSessionHasErrors('avatar_file');
        //dd(session()->all('errors'));
    }

    /** @test */
    public function too_small_image_file_is_rejected()
    {
        //$this->withoutExceptionHandling();
        $user = $this->signIn();
        Storage::fake('public');

        $response = $this->call('PUT', route('users.profile.update', $user), [
        'avatar_file' => UploadedFile::fake()->image('avatar-fake.jpg', 32, 32),
    ])->assertSessionHasErrors('avatar_file');

        //dump(session()->all('errors'));
        //$this->dumpStorage('public');

        Storage::disk('public')->assertMissing('/images/avatars/1/avatar.jpg');
    }

    /** @test */
    public function a_valid_avatar_must_be_provided()
    {
        Storage::fake('public');

        // Make sure fake public is empty:
        $directories = Storage::disk('public')->allDirectories();
        $files = Storage::disk('public')->allFiles();
        $this->assertEquals(0, count($directories));
        $this->assertEquals(0, count($files));

        //$this->withoutExceptionHandling();
        $user = $this->signIn();

        //$file = new UploadedFile(base_path('tests/Support/testfiles/test.jpg'), 'test.jpg', 'image/jpeg', null, $test=true);
        // $this->assertEquals(true, file_exists($file));

        $file = UploadedFile::fake()->image('avatar.jpg', 64, 64); // min dimensions restrictions

        $this->assertEquals(0, Media::all()->count());

        $response = $this->call('PUT', route('users.profile.update', ['user' => $user]),
            [
                'avatar_file' => $file,
            ]);

        //$this->dumpStorage('public', '');

        $this->assertEquals(1, Media::all()->count());

        Storage::disk('public')->assertExists('/images/avatars/'.md5($user->id).'/avatar.jpg');
    }
}
