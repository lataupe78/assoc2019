<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubSectionTest extends TestCase
{
    /** @test */
    public function section_has_many_subsections()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
