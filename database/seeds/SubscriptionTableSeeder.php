<?php

use App\Models\Section;
use App\Models\Subscription;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
class SubscriptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   public function run(Faker $faker)
    {
        $sections = Section::all();

        $divisions = [
			"L1 : Ligue 1",
			"L2 : Ligue 2",
			"N : National",
			"CFA : Championnat de france amateur",
			"CFA2 : Championnat de france amateur 2",
			"DH : Division honneur",
			"DSR : Division supérieure régionale",
			"DHR : Division honneur régionale",
			"PH : Promotion d'honneur",
			"PHR : Promotion d'honneur régionale",
			"PID : Promotion interdistrict",
			"PL : Promotion ligue",
			"PD : Promotion de district",
			"EXC : Excellence",
			"PEXC : Promotion d'Excellence",
			"1S : 1ere série",
			"1D : 1ere division",
			"P1D : Promotion de 1ere division",
			"2D : 2eme division",

			"LSR: Loisirs",
			"VET: Vétérans",
			"ADO: Jeunes de 12 à 18 ans",
			"PE: Enfants de 5 à 11 ans",

       	];

        foreach ($sections as $section) {

        	for($i=0; $i< $faker->numberBetween(3, 8); $i++){
				factory(Subscription::class)->create([
	                'title' => $section->title. ' - ' .$faker->randomElement($divisions),
	                'section_id' => $section->id,
	            ]);
        	}
		}

    }
}
