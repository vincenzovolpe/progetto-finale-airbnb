<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flat extends Model
{
    protected $fillable = [
        'title', 'room_qty', 'bed_qty', 'bath_qty', 'sq_meters', 'address', 'lat', 'lon', 'img_uri'
    ];

}
