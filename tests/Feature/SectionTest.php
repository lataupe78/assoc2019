<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Section;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SectionTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    /** @test */
    public function home_page_show_all_main_sections()
    {
        $this->seed('SectionTableSeeder');

        $sections = Section::parent()->get()->pluck('title')->toArray();

        $response = $this->get('/');
        $response->assertStatus(200);

        foreach ($sections as $main_section) {
            $response->assertSee($main_section);
        }
    }

    /** @test */
    public function it_show_section_content_on_when_visit()
    {
        //$this->withoutExceptionHandling();

        $title = 'Pétanque';
        $slug = str_slug($title);
        $section = factory(Section::class)->create([
            'title' => $title,
            'slug' => $slug,
            'description' => 'contenu section pétanque',
        ]);

        //dump($section);

        $response = $this->get('/section/'.$slug);

        $response->assertStatus(200);

        $response->assertSee($section->title);
        $response->assertSee($section->description);
    }
}
