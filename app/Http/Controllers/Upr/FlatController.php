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
        // recupero i dati dal form
        $data = $request->all();
        // creo un nuovo oggetto Flat da valorizzare
        $flat = new Flat();
        // imposto il campo dell'id user
        $flat->user_id = Auth::user()->id;
        // imposto tutti i campi definiti come fillable nel model Flat
        $flat->fill($data);
        // se l'immagine è stata caricata
        if(!empty($data['img_uri'])) {
            // recupero l'oggeto del file upload
            $uploaded_file = $data['img_uri'];
            // salvo il file nel mio spazio di storage e recupero il suo percorso
            $file_path = Storage::put('images', $uploaded_file);
            // imposto il percorso nel db
            $flat->img_uri = $file_path;
        }
        // salvo l'oggetto
        $flat->save();
        // torno alla view index
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
        // recupero i dati dal form
        $form_data = $request->all();

        // verifico se è stato caricato una nuova immagine
        if(!empty($form_data['img_uri'])) {
            // se già c'era un'immagine mi recupero il percorso e elimino il file dallo storage
            if (!empty($flat['img_uri'])) {
                $img_to_delete = $flat['img_uri'];
                Storage::delete($img_to_delete);
            }
            // recupero l'oggeto del nuovo file upload
            $uploaded_file = $form_data['img_uri'];
            // salvo il file nel mio spazio di storage e recupero il suo percorso
            $file_path = Storage::put('images', $uploaded_file);
            // imposto il percorso nel db
            $flat->img_uri = $file_path;
        }

        // Apporto le modifiche al flat nel DB:
        $flat->update($form_data);
        return redirect()->route('upr.flats.index');
    }

    public function destroy(Flat $flat)
    {
        // Elimino il singolo appartamento (per ora, direttamente e senza messaggio di conferma):

        // se l'appartamento ha l'immagine mi recupero il percorso e elimino il file dallo storage
        if (!empty($flat['img_uri'])) {
            $img_to_delete = $flat['img_uri'];
            Storage::delete($img_to_delete);
        }
        $flat->delete();
        return redirect()->route('upr.flats.index');
    }
}
