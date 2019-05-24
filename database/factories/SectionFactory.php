<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Section;
use Faker\Generator as Faker;

$factory->define(Section::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(),
        //'slug' => str_slug($title),
		'description' => $faker->paragraph(5, true),
		'is_active' => true,
		'position' => 0,
		'parent_id' => null
    ];
});
