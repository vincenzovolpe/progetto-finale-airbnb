<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Flat;

use Faker\Generator as Faker;

$factory->define(Flat::class, function (Faker $faker) {
    return [
        'title' =>('Appartamento in ').$faker->country,
        'room_qty' => $faker->numberBetween($min = 1, $max = 5) ,
        'bed_qty' => $faker->numberBetween($min = 1, $max = 10) ,
        'bath_qty' => $faker->numberBetween($min = 1, $max = 5) ,
        'sq_meters' => $faker->numberBetween($min = 10, $max = 500) ,
        'address' => $faker->streetAddress,
        'lat' => $faker->latitude($min = -90, $max = 90),
        'lon' => $faker->longitude($min = -180, $max = 180),
        'img_uri' => $faker->imageUrl($width = 640, $height = 480),
        'active' => '1',
    ];
});
