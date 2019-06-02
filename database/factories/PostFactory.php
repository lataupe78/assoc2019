<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Post;
use App\Models\User;
use App\Models\Section;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(),
        'excerpt' => $faker->paragraph(),
        'content' => $faker->paragraph(5),
        'is_published' => true,
        'published_at' => $faker->dateTimeBetween('-1 year', 'now'),
        'section_id' => factory(Section::class),
        'author_id' => factory(User::class),
    ];
});
