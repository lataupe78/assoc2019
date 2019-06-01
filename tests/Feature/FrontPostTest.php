<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\Section;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FrontPostTest extends TestCase
{
   use RefreshDatabase;
   use DatabaseMigrations;

   /** @test */
   public function a_section_home_page_shows_last_3_posts_of_the_section()
   {
        $this->withoutExceptionHandling();

        $this->seed('SectionTableSeeder');
        $section = Section::first();

        $posts = factory(Post::class, 4)->create([
            'section_id' => $section->id
        ]);

        $last_3_posts = Post::latest('published_at')->get(3);
        $older_post = Post::oldest('published_at')->first();

        //dump($older_post);

        $response = $this->call('GET', route('sections.show', ['slug' => $section->slug]));
        $response->assertStatus(200);

        foreach($last_3_posts as $post) {
            $response->assertSee($post->title);
        }

        $response->assertDontSee($older_post->title);
    }
}
