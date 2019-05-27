<?php

use App\Models\User;
use App\Models\Section;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // on crée un super admin
        factory(User::class)->create([
            'name' => 'Pascal',
            'email' => 'admin@gmail.com',
            'role' => 'superadmin',
        ]);

        // on crée un admin par sections
        $sections = Section::parent()->select('id', 'title')->get();

        foreach ($sections as $section) {
            $admins = factory(User::class, rand(1, 3))->create(['role' => 'admin']);

            foreach ($admins as $admin) {
                $admin->managed_sections()->attach($section->id);
            }
        }

        // et ajoute 2 - 3 sections à un admin pour test
        $admin1 = User::find(2);
        $admin1->managed_sections()->attach([4, 5, 6]);
        $admin2 = User::find(4);
        $admin2->managed_sections()->attach([6, 7, 8]);
    }
}
