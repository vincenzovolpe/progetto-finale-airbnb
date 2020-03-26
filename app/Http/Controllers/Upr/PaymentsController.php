<?php

namespace App\Http\Controllers\Upr;

use App\Flat;
use App\Sponsor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Braintree_Transaction;

class PaymentsController extends Controller
{

    public function index(Request $request)
    {
        // LOGICA DI VERIFICA UTENTE (vedi show() in FlatController per commenti):
        $logged_user = Auth::user()->id;
        // Trovo gli appartamenti:
        $id = $request["id"];
        $flat = Flat::find($id);
        // Effettuo valutazione:
        $flat_user = $flat->user->id;
        if($logged_user == $flat_user) {
            $id = $request["id"];
            $sponsor_id = $request["sponsor_id"];
            return view('upr.payment', ["id" => $id, "sponsor_id" => $sponsor_id]);
        } else {
            return redirect()->route('upr.flats.index');
        }
    }

    // Funzione per il salvataggio a DB della sponsorizzazione e per il pagamento:
    public function process(Request $request, $id, $sponsor_id)
    {
        // LOGICA DI VERIFICA UTENTE (vedi show() in FlatController per commenti):
        $logged_user = Auth::user()->id;
        // Trovo gli appartamenti:
        $flat = Flat::find($id);
        // Effettuo valutazione:
        $flat_user = $flat->user->id;
        if($logged_user == $flat_user) {
            $sponsor = Sponsor::find($sponsor_id);
            // Logica di Braintree:
            $payload = $request->input('payload', false);
            $nonce = $payload['nonce'];
            $status = Braintree_Transaction::sale([
                'amount' => $sponsor->price,
                'paymentMethodNonce' => $nonce,
                'options' => [
                    'submitForSettlement' => True
                ]
            ]);
            // Visto che posso rinnovare sponsorizzazioni, valutiamo se esiste già una colonna a DB: ne tengo solo una!
            $is_flat_sponsored = DB::table('flat_sponsor')->select("sponsor_id")->where("flat_id", $id)->get();
            // Questa è una collection, di cui posso valutare il count():
            if ($is_flat_sponsored->count()) {
                // Se avevo già degli sponsor, ripulisco il tutto.
                DB::table('flat_sponsor')->where('flat_id', $id)->delete();
            }
            // Salvo nel DB:
            $flat->sponsors()->sync($sponsor);
            $flat->save();
            // Mando risposta a Braintree:
            return response()->json($status);
        } else {
            return redirect()->route('upr.flats.index');
        }
    }
}
