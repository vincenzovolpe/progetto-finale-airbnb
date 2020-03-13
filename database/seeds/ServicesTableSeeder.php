<?php

use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Service::class, 5)->create();
        factory(App\Flat::class)->create()->each(function($a) {
          $a->services()->attach(App\Service::all()->random(1));
        });

    }
}
