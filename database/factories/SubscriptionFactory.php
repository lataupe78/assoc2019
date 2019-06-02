<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Section;
use App\Models\Subscription;
use Faker\Generator as Faker;

$factory->define(Subscription::class, function (Faker $faker) {

	$start =  new \DateTimeImmutable('2019-09-01');
	$end = $start->add(new \DateInterval('PT9M'));

    return [
        'title' => $faker->sentence(),
		'description' => $faker->paragraph(3),

		'starts_at' => $start,
		'expires_at' => $end,

		'is_published' => true,

		'section_id' => factory(Section::class),
		//'author_id' => factory(User::class)
    ];
});
