<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SectionTest extends TestCase
{
    /** @test */
    public function home_page_show_section_list()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
