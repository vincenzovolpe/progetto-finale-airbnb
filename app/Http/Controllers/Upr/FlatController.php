<?php

namespace App\Http\Controllers\Upr;
use App\Flat;
use App\Service;
use App\Sponsor;
use App\Http\Controllers\Controller; // Devo aggiungere questo namespace per dirgli di usare il controller
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class FlatController extends Controller
{

    public function index()
    {
        // Seleziono tutti i Flat dell'utente:
        $utente = Auth::user();
        $flats = $utente->flats()->get();
        // Passo a index delle informazioni riguardo alla sponsorizzazione dell'appartamento:
        $flat_sponsored = DB::table('flats')
        ->join('flat_sponsor', 'flats.id', '=', 'flat_sponsor.flat_id')
        ->join("sponsors", "flat_sponsor.sponsor_id", "=", "sponsors.id")
        ->where("flats.user_id", $utente["id"])
        ->select("flat_id","sponsor_id","hours","flat_sponsor.created_at")
        ->get();
        // Con questo passaggio, customizzo la key della collection!
        $flat_sponsored = $flat_sponsored->keyBy("flat_id")->toArray();
        // Questo restituisce un array di oggetti.
        return view("upr.flats.index", ["flats" => $flats, "flat_sponsored" => $flat_sponsored]);

        // Se un appartamento di questi è già sponsorizzato, non mostro bottone!
        // dd($flat_sponsored->count());
    }

    public function create()
    {
        // Consento la creazione di un nuovo flat:
        // Passo anche tutti i servizi:
        $servizi = Service::all();
        return view("upr.flats.create", compact("servizi"));
    }

    public function store(Request $request)
    {
<<<<<<< HEAD
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
=======
        // recupero i dati dal form
>>>>>>> origin/master
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
        $flat->push();
        // Creo un vettore da active in poi(serve solo per i servizi):
        $service_array_uncut = array_slice($data,10);
        // Questo passaggio serve per eliminare l'image url dall'array di servizi:
        $service_array_cut = array_slice(array_reverse($service_array_uncut),1);
        // Prendo questo vettore e lo inserisco nella tabella pivot appropriata (DA AGGIUNGERE I TIMESTAMPS):
        $flat->services()->attach($service_array_cut);
        // torno alla view index
        return redirect()->route("upr.flats.index");


    }

    public function show($id)
    {
        // Ritrovo l'utente loggato
        $logged_user = Auth::user()->id;

        // Visualizzo la pagina di dettaglio del singolo appartamento:
        $flat = Flat::find($id);

        // Ritrovo l'utente propietario dell'appartamento
        $flat_user = $flat->user->id;
        // Controllo se l'utente loggato è uguale all'utente dell'appartamento (evito così che chiunque mettendo un id possa vedere i dettagli di un altro appartamento non suo)
        if($logged_user == $flat_user) {
            // Cerco nella tabella flat_service tutti i servizi offerti dal mio appartamento:
            $service_on_flat = DB::table("services")
            ->join("flat_service", "services.id", "=", "flat_service.service_id")
            ->where("flat_service.flat_id",$id)
            ->get();
            // Ottengo in uscita una collection, la preparo come un array:
            $service_array = [];
            foreach ($service_on_flat as $single) {
                array_push($service_array,$single->name);
            }
            return view("upr.flats.show", ["flat" => $flat, "service" => $service_array]);
        } else {
            return redirect()->back();
        }

    }

    public function edit(Flat $flat)
    {
        // LOGICA DI VERIFICA UTENTE (vedi show() per commenti):
        $logged_user = Auth::user()->id;
        $flat_user = $flat->user->id;
        if($logged_user == $flat_user) {
            // Visualizzo la pagina di modifica del singolo appartamento:
            $servizi = Service::all();
            // Cerco nella tabella flat_service tutti i servizi offerti dal mio appartamento:
            $servizi_su_appartamento = DB::table("services")
            ->join("flat_service", "services.id", "=", "flat_service.service_id")
            ->where("flat_service.flat_id",$flat->id)
            ->get();
            // Ottengo in uscita una collection, la preparo come un array:
            $servizi_su_appartamento_array = [];
            foreach ($servizi_su_appartamento as $single) {
                array_push($servizi_su_appartamento_array,$single->name);
            }
            // Passo alla mia view tutti gli array:
            return view("upr.flats.edit", ["flat" => $flat, "servizi" => $servizi, "servizi_su_appartamento_array" => $servizi_su_appartamento_array]);
        } else {
            return redirect()->back();
        }
    }

    public function update(Request $request, Flat $flat)
    {
<<<<<<< HEAD
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
=======
        // recupero i dati dal form
>>>>>>> origin/master
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

        // Creo un vettore da active in poi(serve solo per i servizi):
        $service_array_edit = array_slice($form_data,11);
        // Se in questo array ho img_uri, andrà eliminato.
        if (!empty($form_data["img_uri"])) {
            // Visto che img_uri sarà l'ultimo elemento dell'array, dovrò eliminarlo così:
            $service_array_edit = array_slice(array_reverse($service_array_edit),1);
        }
        // Se non ho aggiunto o modificato servizi, non dovrò fare nulla. Quindi:
        if ($service_array_edit) {
            // Prima elimino le righe della tabella flat_service che ci interessano:
            DB::table('flat_service')->where('flat_id', $flat["id"])->delete();
            // Poi aggiungo i servizi inseriti:
            $flat->services()->attach($service_array_edit);
        }
        // torno alla view index
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

    // Funzione per andare alla pagina di sponsorizzazione del singolo appartamento!
    public function sponsor(Flat $flat)
    {
        // LOGICA DI VERIFICA UTENTE (vedi show() per commenti):
        $logged_user = Auth::user()->id;
        $flat_user = $flat->user->id;
        if($logged_user == $flat_user) {
            $sponsor = Sponsor::all();
            // Per evitare che l'utente acceda direttamente alla pagina di sponsorizzazione tramite la scrittura diretta nell'url, controllo se esistono già delle sponsorizzazioni presenti nel DB per questo appartamento:
            $flat_sponsored = DB::table('flat_sponsor')->select("flat_id")->where("flat_id",$flat->id)->get();
            if (!$flat_sponsored->count()) {
                return view('upr.flats.sponsor', ["flat" => $flat, "sponsor" => $sponsor]);
            } else {
                // Se ho già delle sponsorizzazioni attive, non devo attivarne altre!
                return redirect()->route('upr.flats.index');
            }
        } else {
            return redirect()->back();
        }
    }

    // Funzione per
    public function submitSponsor(Request $request, Flat $flat)
    {
        $data = $request->all();
        // Ho inserimento diretto nel DB, controllo di avere valori numerici:
        if (is_numeric($data["flat_id"]) && is_numeric($data["sponsor_id"])) {
            DB::insert('insert into flat_sponsor (flat_id, sponsor_id) values (?, ?)', [$data["flat_id"], $data["sponsor_id"]]);
            return redirect()->route('upr.flats.index');
        } else {
            return redirect()->back();
        }
    }

}
