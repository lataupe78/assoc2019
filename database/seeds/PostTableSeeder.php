<?php

use App\Models\Post;
use App\Models\Section;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $sections = Section::all();
        $sections->load('admins');

        foreach ($sections as $section) {
            $admins = $section->admins;

            factory(Post::class, $faker->numberBetween(3, 6))->create([
                'section_id' => $section->id,
                'author_id' => ($admins)
                    ? $faker->randomElement($admins)->id
                    : null,
            ]);
        }
    }
}
