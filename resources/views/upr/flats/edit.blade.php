@extends("layouts.upr")
@section("content")
<div class="container">
    <div class="row">
        <h1>EDIT FLAT DETAILS</h1>
        <a class="btn btn-info" href="{{ route('upr.flats.index') }}">Back to index!</a>
    </div>
    <div class="row">
        <div class="col">


            <form method="POST" action="{{ route('upr.flats.update', ['flat' => $flat->id]) }}" enctype="multipart/form-data">

                @csrf
                @method('PUT')
                <!-- Inserimento titolo(descrizione) -->
                <div class="form-group row">
                    <label for="title" class="col-md-8 col-form-label text-md-center">{{ __('Description') }}</label>
                    <div class="col-md-8">
                        <input id="title" class="form-control @error('title') is-invalid @enderror" type="text" name="title" value="{{ $flat->title }}" required>
                    </div>
                    <div class="title valid-feedback">
                        Inserimento corretto!
                    </div>
                    <div class="title invalid-feedback">
                        Inserisci una descrizione valida - min 5 caratteri
                    </div>
                </div>
                <!-- Inserimento numero di stanze -->
                <div class="form-group row">
                    <label for="room_qty" class="col-md-3 col-form-label text-md-left">{{ __('Number of rooms') }}</label>
                    <div class="col-md-3">
                        <input id="room_qty" class="form-control @error('room_qty') is-invalid @enderror" type="number" name="room_qty" value="{{ $flat->room_qty }}" required>
                        <div class="room_qty valid-feedback">
                            Inserimento corretto!
                        </div>
                        <div class="room_qty invalid-feedback">
                            Inserisci un numero valido
                        </div>
                    </div>
                </div>
                <!-- Inserimento numero di letti -->
                <div class="form-group row">
                    <label for="bed_qty" class="col-md-3 col-form-label text-md-left">{{ __('Number of beds') }}</label>
                    <div class="col-md-3">
                        <input id="bed_qty" class="form-control @error('bed_qty') is-invalid @enderror" type="number" name="bed_qty" value="{{ $flat->bed_qty }}" required>
                        <div class="bed_qnty valid-feedback">
                            Inserimento corretto!
                        </div>
                        <div class="bed_qnty invalid-feedback">
                            Inserisci un numero valido
                        </div>
                    </div>
                </div>
                <!-- Inserimento numero di bagni -->
                <div class="form-group row">
                    <label for="bath_qty" class="col-md-3 col-form-label text-md-left">{{ __('Number of baths') }}</label>
                    <div class="col-md-3">
                        <input id="bath_qty" class="form-control @error('bath_qty') is-invalid @enderror" type="number" name="bath_qty" value="{{ $flat->bath_qty }}" required>
                        <div class="bath_qty valid-feedback">
                            Inserimento corretto!
                        </div>
                        <div class="bath_qty invalid-feedback">
                            Inserisci un numero valido
                        </div>
                    </div>
                </div>
                <!-- Inserimento metri quadri -->
                <div class="form-group row">
                    <label for="sq_meters" class="col-md-3 col-form-label text-md-left">{{ __('Square meters') }}</label>
                    <div class="col-md-3">
                        <input id="sq_meters" class="form-control @error('sq_meters') is-invalid @enderror" type="number" name="sq_meters" value="{{ $flat->sq_meters }}" required>
                        <div class="sq_meters valid-feedback">
                            Inserimento corretto!
                        </div>
                        <div class="sq_meters invalid-feedback">
                            Inserisci un valore valido compreso tra 10 e 500
                        </div>
                    </div>
                </div>
                
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
