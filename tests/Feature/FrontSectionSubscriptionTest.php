<?php

namespace Tests\Feature;

use App\Models\Section;
use App\Models\Subscription;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FrontSectionSubscriptionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_section_can_have_subscriptions()
    {
        $this->withoutExceptionHandling();

        $section = factory(Section::class)->create();
        //dump($section);
        //
        $now =  new \DateTimeImmutable();
        $subscriptions = factory(Subscription::class)->create([
            'section_id' => $section->id,
            'starts_at' => $now->sub(new \DateInterval('P3M')),
            'expires_at' => $now->add(new \DateInterval('P9M')),
        ]);

        //  dd($subscriptions);

        $response = $this->call('GET', route('subscriptions.show', ['section' => $section]));

            $response->assertStatus(200);
            $response->assertSee($subscriptions->title);
    }
}
