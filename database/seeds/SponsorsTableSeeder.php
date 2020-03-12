<?php

use Illuminate\Database\Seeder;

class SponsorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
         factory(App\Sponsor::class, 5)->create();
         factory(App\Flat::class)->create()->each(function($a) {
           $a->sponsors()->attach(App\Sponsor::all()->random(1));
         });

     }
}
