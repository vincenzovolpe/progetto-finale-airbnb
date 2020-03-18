@extends("layouts.upr")
@section("content")
<div class="container">
    <div class="row">
        <h1>EDIT FLAT DETAILS</h1>
        <a class="btn btn-info" href="{{ route('upr.flats.index') }}">Back to index!</a>
    </div>
    <div class="row">
        <div class="col">
            {{-- Copiato dalla create Umberto:Imposto un ciclo per mostare gli errori avvenuti in fase di compilazione del form --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('upr.flats.update', ['flat' => $flat->id]) }}" enctype="multipart/form-data">

                @csrf
                @method('PUT')
                <!-- Inserimento titolo(descrizione) -->
                <label for="title" class="col-md-8 col-form-label text-md-right">{{ __('Description') }}</label>
                <input id="title" type="text" name="title" value="{{ $flat->title }}" required>
                <!-- Inserimento numero di stanze -->
                <label for="room_qty" class="col-md-8 col-form-label text-md-right">{{ __('Number of rooms') }}</label>
                <input id="room_qty" type="number" name="room_qty" value="{{ $flat->room_qty }}" required>
                <!-- Inserimento numero di letti -->
                <label for="bed_qty" class="col-md-8 col-form-label text-md-right">{{ __('Number of beds') }}</label>
                <input id="bed_qty" type="number" name="bed_qty" value="{{ $flat->bed_qty }}" required>
                <!-- Inserimento numero di bagni -->
                <label for="bath_qty" class="col-md-8 col-form-label text-md-right">{{ __('Number of baths') }}</label>
                <input id="bath_qty" type="number" name="bath_qty" value="{{ $flat->bath_qty }}" required>
                <!-- Inserimento metri quadri -->
                <label for="sq_meters" class="col-md-8 col-form-label text-md-right">{{ __('Square meters') }}</label>
                <input id="sq_meters" type="number" name="sq_meters" value="{{ $flat->sq_meters }}" required>
                <!-- Inserimento indirizzo -->
                <input id="address" type="text" name="address" value="{{ $flat->address }}" required hidden>
                <div id="address-edit" class="fuzzy-edit">
                </div>
                {{-- <label for="address" class="col-md-8 col-form-label text-md-right">{{ __('Adress') }}</label> --}}

                <!-- Inserimento lat recuperato da API tomtom se viene modificato l'indirizzo -->
                {{-- <label for="lat" class="col-md-8 col-form-label text-md-right">{{ __('Latitude') }}</label> --}}
                <input id="lat" type="text" name="lat" value="{{ $flat->lat }}" >
                <!-- Inserimento lon recuperato da API tomtom se viene modificato l'indirizzo  -->
                {{-- <label for="lon" class="col-md-8 col-form-label text-md-right">{{ __('Longitude') }}</label> --}}
                <input id="lon" type="text" name="lon" value="{{ $flat->lon }}" >
                <!-- Inserimento active -->
                @if($flat->active)
                    <br>
                    <input type="radio" id="active" name="active" value="1" required checked>
                    <label for="active" class="col-form-label text-md-right">{{ __('Visualizza su sito!') }}</label>
                    <br>
                    <input type="radio" id="active" name="active" value="0" required>
                    <label for="active" class="col-form-label text-md-right">{{ __('Non visualizzare su sito!') }}</label>
                    <br>
                @else
                    <br>
                    <input type="radio" id="active" name="active" value="1" required>
                    <label for="active" class="col-form-label text-md-right">{{ __('Visualizza su sito!') }}</label>
                    <br>
                    <input type="radio" id="active" name="active" value="0" required checked>
                    <label for="active" class="col-form-label text-md-right">{{ __('Non visualizzare su sito!') }}</label>
                    <br>
                @endif
                <!-- Inserimento uri immagine -->
                <input id="img_uri" type="file" class="form-control-file" name="img_uri">
                <label for="img_uri">carica una nuova immagine per sostituire quella attuale...</label>

                <!-- PARTE DEI SERVIZI: -->
                <h3>Aggiungi servizi al tuo appartamento:</h3>
                @forelse ($servizi as $service)
                    @if(in_array($service->name, $servizi_su_appartamento_array))
                    <input type="checkbox" id="{{ $service->id }}" name="{{ $service->name }}" value="{{ $service->id }}" checked>
                    @else
                    <input type="checkbox" id="{{ $service->id }}" name="{{ $service->name }}" value="{{ $service->id }}">
                    @endif
                    <label for="{{ $service->id }}">{{ $service->name }}</label><br>
                @empty
                    <p>Non abbiamo nessun servizio attivo al momento! :(</p>
                @endforelse


                <!-- Invio modulo -->
                <button type="submit" class="btn btn-primary">Submit changes!</button>
            </form>
        </div>
        <div class="col">
            <h4>{{ $flat->title }}</h4>
            <img class="card-img" src="{{asset('storage/' .$flat->img_uri)}}" alt="">
        </div>
    </div>
</div>
@endsection
