<?php

namespace App\Http\Controllers;

use Session;
use App\Flat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class FlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function find(Request $request)
    {
        $lati = $request['lat'];
        $long = $request['lon'];

        // $flats20km = DB::select(DB::raw("
        // SELECT *,
        // ( 6371 * acos( cos( radians('$lati') ) * cos( radians( lat ) ) * cos( radians( lon )
        // - radians('$long') ) + sin( radians('$lati') ) * sin( radians( lat ) ) ) )
        // AS distance FROM flats HAVING distance < 20 ORDER BY distance LIMIT 0 , 20;


        // "));
        dd($request['lat']);

        $flatsKm = DB::select( DB::raw("
        SELECT *, ( 6371 * acos( cos( radians($request['lat']) ) * cos( radians( lat ) ) *
cos( radians( lon ) - radians($request['lon']) ) + sin( radians($request['lat']) ) *
sin( radians( lat ) ) ) ) AS distance FROM flats HAVING
distance < 20 ORDER BY distance LIMIT 0 , 20
        ")); 



        return view('find_flat');
    }
    //
    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }
    //
    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }
    //
    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Flat  $flat
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Flat $flat)
    // {
    //     //
    // }
    //
    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Flat  $flat
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(Flat $flat)
    // {
    //     //
    // }
    //
    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Flat  $flat
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, Flat $flat)
    // {
    //     //
    // }
    //
    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Flat  $flat
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Flat $flat)
    // {
    //     //
    // }
}
