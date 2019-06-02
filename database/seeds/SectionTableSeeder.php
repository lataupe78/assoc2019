<?php

use App\Models\Section;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class SectionTableSeeder extends Seeder
{
    protected $main_sections = [
        [
            'title' => 'Aïkido',
            'icon' => 'aikido',
        ],
        [
            'title' => 'Badminton',
            'icon' => 'badminton',
        ],
        [
            'title' => 'Floorball',
            'icon' => 'floorball',
        ],
        [
            'title' => 'Handball',
            'icon' => 'handball',
        ],
        [
            'title' => 'Karaté',
            'icon' => 'karate',
        ],
        [
            'title' => 'Rugby',
            'icon' => 'rugby',
        ],
        [
            'title' => 'Tennis de Table',
            'icon' => 'tennis-de-Table',
        ],
        [
            'title' => 'Volleyball',
            'icon' => 'Volley-ball',
        ],
    ];

    public function run(Faker $faker)
    {
        foreach ($this->main_sections as $main_section) {
            //$admins = [];
            //
            $this->section = factory(Section::class)->create([
                'title' => $main_section['title'],
                'slug' => str_slug($main_section['title']),
                'parent_id' => null,
            ]);
        }
    }
}
