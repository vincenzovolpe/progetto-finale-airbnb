<?php

use Illuminate\Database\Seeder;
use App\Flat;

class FlatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
         $flats = config('flats.flat_db');
         foreach ($flats as $flat) {
             $nuovo_flat = new Flat();
             $nuovo_flat->fill($flat);
             $nuovo_flat->save();
         }
     }
}
