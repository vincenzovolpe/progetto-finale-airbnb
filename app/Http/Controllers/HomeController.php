<?php

namespace App\Http\Controllers;

use App\Flat;
use App\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index()
    {
        $flats = Flat::where('active', 1)->orderBy('created_at', 'desc')->get();
        foreach ($flats as $flat) {
            $flat_sponsor = $flat->sponsors->toArray();

            foreach ($flat_sponsor as $sponsor) {

                $flat_sponsored = DB::table('flats')
                ->join('flat_sponsor', 'flats.id', '=', 'flat_sponsor.flat_id')
                ->where('flat_sponsor.created_at', '>=', DB::raw('DATE_SUB(NOW(), INTERVAL '.$sponsor['hours'].' HOUR)'))
                ->orderBy('flat_sponsor.created_at', 'desc')
                ->get();
                
            }
        }

        if(!empty($flat_sponsored)){
            return view('home', ['flats' => $flats, 'flat_sponsored' => $flat_sponsored]);
        } else  {
            return view('home', ['flats' => $flats]);
        }
    }
}
