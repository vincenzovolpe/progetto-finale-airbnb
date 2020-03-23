<?php

namespace App\Http\Controllers\Upr;

use App\Flat;
use App\Sponsor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree_Transaction;

class PaymentsController extends Controller
{

    public function index(Request $request)
    {
        $id = $request["id"];
        $sponsor_id = $request["sponsor_id"];
        return view('upr.payment', ["id" => $id, "sponsor_id" => $sponsor_id]);
    }

    public function process(Request $request, $id, $sponsor_id)
    {
        // Trovo gli appartamenti
        $flat = Flat::find($id);
        $sponsor = Sponsor::find($sponsor_id);

        $payload = $request->input('payload', false);
        $nonce = $payload['nonce'];

        $status = Braintree_Transaction::sale([
    	'amount' => $sponsor->price,
    	'paymentMethodNonce' => $nonce,
    	'options' => [
    	    'submitForSettlement' => True
    	]
        ]);

        $flat->sponsors()->sync($sponsor);

        $flat->save();

        return response()->json($status);
    }
}
