@extends("layouts.upr")
@section("content")
<div id="show-details" class="container mb-5">
    <div class="row my-5">
        <div class="col-lg-12">
            <h1 class="float-left">Modifica i dettagli</h1>
            <a class="btn btn-info float-right" href="{{ route('upr.flats.index') }}">torna indietro</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <form method="POST" action="{{ route('upr.flats.update', ['flat' => $flat->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Inserimento titolo(descrizione) -->
                <div class="form-group row">
                    <label for="title" class="col-form-label col-sm-3">{{ __('Description') }}</label>
                    <div class="col-sm-9">
                        <input id="title" class="form-control @error('title') is-invalid @enderror" type="text" name="title" value="{{ $flat->title }}" required>
                        <div class="title valid-feedback">
                            Inserimento corretto!
                        </div>
                        <div class="title invalid-tooltip">
                            Inserisci una descrizione valida - min 5 caratteri
                        </div>
                    </div>
                </div>
                <!-- Inserimento numero di stanze -->
                <div class="form-group row">
                    <label for="room_qty" class="col-sm-3 col-form-label text-md-left">{{ __('Number of rooms') }}</label>
                    <div class="col-sm-2">
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
                    <label for="bed_qty" class="col-sm-3 col-form-label">{{ __('Number of beds') }}</label>
                    <div class="col-sm-2">
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
                    <label for="bath_qty" class="col-sm-3 col-form-label text-md-left">{{ __('Number of baths') }}</label>
                    <div class="col-sm-2">
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
                    <label for="sq_meters" class="col-sm-3 col-form-label text-md-left">{{ __('Square meters') }}</label>
                    <div class="col-sm-2">
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
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label text-md-left tt-address-label">indirizzo</label>
                    <div class="col-sm-9">
                        <input id="address" type="text" name="address" value="{{ $flat->address }}" required hidden>
                        <div id="address-edit" class="fuzzy-edit">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label text-md-left">coordinate</label>
                    <div class="col-sm-3">
                        <!-- Inserimento lat recuperato da API tomtom se viene modificato l'indirizzo -->
                        <input id="lat" class="form-control" type="text" name="lat" value="{{ $flat->lat }}" >
                    </div>
                    <div class="col-sm-3">
                        <!-- Inserimento lon recuperato da API tomtom se viene modificato l'indirizzo  -->
                        <input id="lon" class="form-control" type="text" name="lon" value="{{ $flat->lon }}" >
                    </div>
                </div>

                <!-- Inserimento active -->
                <div class="form-group row">
                    <div class="col-sm-12">
                        @if($flat->active)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="active" name="active" value="1" required checked>
                            <label for="active" class="col-form-label text-md-right">{{ __('Visualizza su sito') }}</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="active" name="active" value="0" required>
                            <label for="active" class="col-form-label text-md-right">{{ __('Non visualizzare su sito') }}</label>
                        </div>
                        @else
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="active" name="active" value="1" required>
                            <label for="active" class="col-form-label text-md-right">{{ __('Visualizza su sito') }}</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="active" name="active" value="0" required checked>
                            <label for="active" class="col-form-label text-md-right">{{ __('Non visualizzare su sito') }}</label>
                        </div>
                    @endif
                    </div>
                </div>
                <!-- Inserimento uri immagine -->
                <div class="col-form-group row">
                    <div class="col-sm-12">
                        <label for="img_uri" class="form-control-label">carica una nuova immagine per sostituire quella attuale.</label>
                        <input id="img_uri" type="file" class="form-control-file" name="img_uri">
                    </div>
                </div>

                <!-- PARTE DEI SERVIZI: -->
                <h3 class="mt-4">Aggiungi servizi al tuo appartamento:</h3>
                    <div class="col-form-group row">
                        <div class="col-sm-12">
                            @forelse ($servizi as $service)
                                @if(in_array($service->name, $servizi_su_appartamento_array))
                                <input type="checkbox" id="{{ $service->id }}" name="{{ $service->name }}" value="{{ $service->id }}" checked>
                                @else
                                <input type="checkbox" id="{{ $service->id }}" name="{{ $service->name }}" value="{{ $service->id }}">
                                @endif
                                <label for="{{ $service->id }}"><i class="{{ $service->fa_icon }} mx-2"></i> {{ $service->name }}</label><br>
                            @empty
                                <p>Non abbiamo nessun servizio attivo al momento! :(</p>
                            @endforelse
                        </div>
                    </div>
                <!-- Invio modulo -->
                <button type="submit" class="btn btn-primary my-3">Submit changes!</button>
            </form>
        </div>
        <div class="col">
            <h4>{{ $flat->title }}</h4>
            <img class="card-img" src="{{asset('storage/' .$flat->img_uri)}}" alt="">
        </div>
    </div>
</div>
@endsection
