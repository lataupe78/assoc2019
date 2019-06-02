<?php

namespace Tests\Unit;

use App\Models\Section;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SectionTest extends TestCase
{
	use RefreshDatabase;


    /** @test */
    public function a_section_has_a_slug()
    {
         $section = factory(Section::class)->create();
       	$this->assertEquals(str_slug($section->title), $section->slug);
    }
}
