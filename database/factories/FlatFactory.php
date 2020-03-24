<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Flat;

use Faker\Generator as Faker;

$factory->define(Flat::class, function (Faker $faker) {
    return [
        'title' =>('Appartamento in ').$faker->randomElement(['Roma','Parigi','Madrid','Barcellona','Berlino','Milano','Napoli','Torino','Venezia','New York','Los Angeles','Amsterdam']),
        'room_qty' => $faker->numberBetween($min = 1, $max = 5) ,
        'bed_qty' => $faker->numberBetween($min = 1, $max = 10) ,
        'bath_qty' => $faker->numberBetween($min = 1, $max = 5) ,
        'sq_meters' => $faker->numberBetween($min = 10, $max = 500) ,
        'address' => $faker->streetAddress,
        'lat' => $faker->latitude($min = -90, $max = 90),
        'lon' => $faker->longitude($min = -180, $max = 180),
        'img_uri' => $faker->randomElement(['https://cdn.pixabay.com/photo/2014/08/11/21/39/wall-416060_960_720.jpg','https://cdn.pixabay.com/photo/2017/03/19/01/43/living-room-2155376_960_720.jpg','https://cdn.pixabay.com/photo/2014/07/31/21/41/apartment-406901_960_720.jpg','https://cdn.pixabay.com/photo/2015/03/26/09/42/bedroom-690129_960_720.jpg','https://cdn.pixabay.com/photo/2018/08/15/20/53/bad-3609070_960_720.jpg','https://cdn.pixabay.com/photo/2015/10/12/15/00/room-984076_960_720.jpg','https://cdn.pixabay.com/photo/2015/03/26/09/41/condominium-690086_960_720.jpg','https://cdn.pixabay.com/photo/2016/07/26/18/30/kitchen-1543493_960_720.jpg','https://cdn.pixabay.com/photo/2018/01/26/08/15/dining-room-3108037_960_720.jpg','https://cdn.pixabay.com/photo/2017/12/27/14/41/window-3042834_960_720.jpg','https://cdn.pixabay.com/photo/2017/02/24/12/19/apartment-2094666_960_720.jpg','https://cdn.pixabay.com/photo/2017/02/24/12/22/kitchen-2094707_960_720.jpg']),
        'active' => '1',
    ];
});
