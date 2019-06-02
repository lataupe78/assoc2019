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


    /** @test */
    public function each_post_has_a_dedicated_page(){

        $this->seed('SectionTableSeeder');
        $this->seed('UserTableSeeder');
        $this->seed('PostTableSeeder');

        $firstSection = Section::first();


        $postsforSection = Post::with([
            'section' => function($q){
                $q->select('id', 'title', 'slug');
            },
            'author' => function($q){
                $q->select('id', 'name');
            }
        ])->where('section_id', $firstSection->id)
        ->get();

        foreach($postsforSection as $post) {
             $response = $this->call('GET', route('posts.show', [
                'section' => $post->section,
                'post' => $post
            ]))
            ->assertStatus(200)
            ->assertSee($firstSection->title)
            ->assertSee($post->title)
            ->assertSee($post->published_at->format('d/m/Y'))
            ->assertSee($post->author->name)
            ->assertSee($post->content);

        }
    }


    /** @test */
    public function each_section_provides_a_post_page(){

        //$this->withoutExceptionHandling();

        $this->seed('SectionTableSeeder');
        $section = Section::first();

        $posts = factory(Post::class, 4)->create([
            'section_id' => $section->id
        ]);

        $response = $this->call('GET', route('posts.index', ['section' => $section]))
            ->assertStatus(200);

        foreach($posts as $post) {
            $response->assertSee($post->title);
        }

    }
}
