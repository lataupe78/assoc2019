<?php

namespace Tests\Feature;

use App\Models\Section;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

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

        foreach($sections as $main_section){
            $response->assertSee($main_section);
        }


    }
}
