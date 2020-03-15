<?php

namespace App\Http\Controllers\Upr;
use App\Flat;
use App\Http\Controllers\Controller; // Devo aggiungere questo namespace per dirgli di usare il controller
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FlatController extends Controller
{

    public function index()
    {
        // Seleziono tutti i Flat dell'utente:
        $utente = Auth::user();
        $flats = $utente->flats()->get();
        return view("upr.flats.index", compact("flats"));
    }

    public function create()
    {
        // Consento la creazione di un nuovo flat:
        return view("upr.flats.create");
    }

    public function store(Request $request)
    {
        // Umberto:Creo le validation per la creazione di un nuovo FLAT
        $request->validate([
            'title' => 'required|min:10|max:255',
            'room_qty' => 'required|numeric|min:1',
            'bed_qty' => 'required|numeric|min:1',
            'bath_qty' => 'required|numeric|min:1',
            'sq_meters' => 'required|numeric|max:500',
            'address' => 'required|min:10',
            'lat' => '',
            'lon' => '',
            'active' => 'required|boolean',
            'img_uri' => 'image',

        ]);
        // Metto il flat nel DB:
        $data = $request->all();
        // recupero l'oggeto del file upload
        $uploaded_file = $data['img_uri'];
        // salvo il file nel mio spazio di storage e recupero il suo percorso
        $file_path = Storage::put('images', $uploaded_file);
        $flat = new Flat();
        $flat->user_id = Auth::user()->id;
        $flat->fill($data);
        $flat->img_uri = $file_path;
        $flat->save();
        return redirect()->route("upr.flats.index");


    }

    public function show($id)
    {
        // Visualizzo la pagina di dettaglio del singolo appartamento:
        $flat = Flat::find($id);
        return view("upr.flats.show", ["flat" => $flat]);
    }

    public function edit(Flat $flat)
    {
        // Visualizzo la pagina di modifica del singolo appartamento:
        return view("upr.flats.edit", ["flat" => $flat]);
    }

    public function update(Request $request, Flat $flat)
    {
        // Umberto:Creo le validation per la modifica di un nuovo FLAT
        $request->validate([
            'title' => 'required|min:10|max:255',
            'room_qty' => 'required|numeric|min:1',
            'bed_qty' => 'required|numeric|min:1',
            'bath_qty' => 'required|numeric|min:1',
            'sq_meters' => 'required|numeric|max:500',
            'address' => 'required|min:10',
            'lat' => '',
            'lon' => '',
            'active' => 'required|boolean',

        ]);

        // Apporto le modifiche al flat nel DB:
        $form_data = $request->all();
        $flat->update($form_data);
        return redirect()->route('upr.flats.index');
    }

    public function destroy(Flat $flat)
    {
        // Elimino il singolo appartamento (per ora, direttamente e senza messaggio di conferma):
        $flat->delete();
        return redirect()->route('upr.flats.index');
    }
}
