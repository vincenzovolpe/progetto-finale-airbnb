<?php

namespace App\Http\Controllers;

use App\Flat;
use App\Sponsor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

    public function detailsFlat(Request $request, $id)
    {
        $flat = Flat::find($id);
        //dd(Auth::user()->flats->count());

        // Se è un utente ospite oppure un utente loggato senza appartamenti
        if(!Auth::user() OR (Auth::user() && Auth::user()->flats->count() == 0)) {
            $flat->increment('view');
        // Se è un utente loggato con appartamenti
        } elseif (Auth::user() && Auth::user()->flats->count() > 0) {
            // Cerco gli appartamenti appartenenti all'utente
            $user_flats  = Auth::user()->flats->toArray();
            // Ricavo lo user_id degli appartamenti dell'utente
            foreach ($user_flats as $user_flat) {
                $user_id_flats = $user_flat['user_id'];
            }
            // Controllo se la casa appartiene all'utente loggato che ha appartamenti
            if($user_id_flats != $flat['user_id']) {
                $flat->increment('view');
            }
        }

        return view('details_flat', ['flat' => $flat]);
    }
}
