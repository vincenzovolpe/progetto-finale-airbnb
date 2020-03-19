<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Flat;
use App\Service;
use Illuminate\Support\Facades\DB;

class SearchFlatController extends Controller
{
    public function index() {

        
        $flats = DB::select( DB::raw("
            SELECT *, ( 6371 * acos( cos( radians('$lon') ) * cos( radians( lat ) ) *
            cos( radians( lon ) - radians('$lat') ) + sin( radians('$lon') ) *
            sin( radians( lat ) ) ) ) AS distance FROM flats HAVING
            distance < 20 ORDER BY distance LIMIT 0 , 20
        "));

        return response()->json(
            [
                'success' => true,
                'result' => $flats
            ]
        );
    }
}
