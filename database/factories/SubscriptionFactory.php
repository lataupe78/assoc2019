<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Section;
use App\Models\Subscription;
use Faker\Generator as Faker;





$factory->define(Subscription::class, function (Faker $faker) {


	$date =  $faker->dateTimeThisYear('+1 year'); //new \DateTimeImmutable('2019-09-01');

	$start = \DateTimeImmutable::createFromMutable( $date );
	$interval = new \DateInterval('P'.$faker->numberBetween(5, 12).'M');
	$end = $start->add($interval);

	//$end = $start->add(new \DateInterval('PT'.$faker->numberBetween(5, 12).'M'));

    return [
        'title' => $faker->sentence(3),
		'description' => $faker->paragraph(2),

		'starts_at' => $start,
		'expires_at' => $end,

		'is_published' => true,

		'section_id' => factory(Section::class),
		//'author_id' => factory(User::class)
    ];
});
