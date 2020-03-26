@extends("layouts.upr")
@section("content")
<div id="upr-create" class="container mb-5">
    <div class="row my-5">
        <div class="col-lg-12">
            <h1>Inserisci un nuovo appartamento</h1><br>
            <a class="btn btn-info float-right" href="{{ route('upr.flats.index') }}">torna indietro</a>
            <p>Riempire tutti i campi del modulo.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <form method="POST" action="{{ route('upr.flats.store') }}" enctype="multipart/form-data">
                @csrf
                <!-- Inserimento titolo(descrizione) -->
                <div class="form-group row">
                    <label for="title" class="col-sm-3 col-form-label text-md-left">{{ __('Description') }}</label>
                    <div class="col-md-9">
                        <input id="title" class="form-control @error('title') is-invalid @enderror" type="text" name="title" value="{{ old('title')}}" required>
                        <div class="title invalid-tooltip">
                            Inserisci una descrizione valida - min 5 caratteri
                        </div>
                    </div>
                </div>
                <!-- Inserimento numero di stanze -->
                <div class="form-group row">
                    <label for="room_qty" class="col-sm-3 col-form-label text-md-left">{{ __('Number of rooms') }}</label>
                    <div class="col-sm-3">
                        <input id="room_qty" class="form-control @error('room_qty') is-invalid @enderror" type="number" name="room_qty" value="{{ old('room_qty')}}" required>
                        <div class="room_qty invalid-tooltip">
                            Inserisci un numero valido
                        </div>
                    </div>
                </div>
                <!-- Inserimento numero di letti -->
                <div class="form-group row">
                    <label for="bed_qty" class="col-sm-3 col-form-label text-md-left">{{ __('Number of beds') }}</label>
                    <div class="col-sm-3">
                        <input id="bed_qty" class="form-control @error('bed_qty') is-invalid @enderror" type="number" name="bed_qty" value="{{ old('bed_qty')}}" required>
                        <div class="bed_qnty invalid-tooltip">
                            Inserisci un numero valido
                        </div>
                    </div>
                </div>
                <!-- Inserimento numero di bagni -->
                <div class="form-group row">
                    <label for="bath_qty" class="col-sm-3 col-form-label text-md-left">{{ __('Number of baths') }}</label>
                    <div class="col-sm-3">
                        <input id="bath_qty" class="form-control @error('bath_qty') is-invalid @enderror" type="number" name="bath_qty" value="{{ old('bath_qty')}}" required>
                        <div class="bath_qty invalid-tooltip">
                            Inserisci un numero valido
                        </div>
                    </div>
                </div>
                <!-- Inserimento metri quadri -->
                <div class="form-group row">
                    <label for="sq_meters" class="col-sm-3 col-form-label text-md-left">{{ __('Square meters') }}</label>
                    <div class="col-sm-3">
                        <input id="sq_meters" class="form-control @error('sq_meters') is-invalid @enderror" type="number" name="sq_meters" value="{{ old('sq_meters')}}" required>
                        <div class="sq_meters invalid-tooltip">
                            Inserisci un valore valido compreso tra 10 e 500
                        </div>
                    </div>
                </div>

                <!-- searchbox indirizzo collegato a tomtom -->
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label text-md-left tt-address-label">indirizzo</label>
                    <div class="col-sm-9">
                        {{-- <input id="address" type="text" name="address" value="{{ $flat->address }}" required hidden> --}}
                        <div id="address-edit" class="fuzzy-create">
                        </div>
                    </div>
                </div>

                <!-- Inserimento latitudine recuperato da API tomtom -->
                <input id="lat" type="text" name="lat" hidden>
                <!-- Inserimento longitudine recuperato da API tomtom -->
                <input id="lon" type="text" name="lon" hidden>

                <!-- Inserimento active -->

                <!-- Inserimento active -->
                <div class="form-group row">
                    <div class="col-sm-12">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="active" name="active" value="1" required>
                            <label for="active" class="col-form-label text-md-right">{{ __('Visualizza su sito!') }}</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="active" name="active" value="0" required>
                            <label for="active" class="col-form-label text-md-right">{{ __('Non visualizzare su sito!') }}</label>
                        </div>
                    </div>
                </div>

                <!-- Inserimento uri immagine -->
                <div class="col-form-group row">
                    <div class="col-sm-12">
                        <label for="img_uri" class="form-control-label">carica una foto dell'appartamento.</label>
                        <input id="img_uri" type="file" class="form-control-file @error('img_uri') is-invalid @enderror" name="img_uri">
                        <div class="img_uri invalid-tooltip">
                            Inserisci un'immagine non superiore ai 5MB
                        </div>
                    </div>
                </div>

                <!-- PARTE DEI SERVIZI: -->
                <h4 class="mt-4">Indica quali servizi aggiuntivi sono disponibili</h4>
                <div class="col-form-group row">
                    <div class="col-sm-12">
                        @forelse ($servizi as $service)
                            <input type="checkbox" id="{{ $service -> id }}" name="{{ $service -> name }}" value="{{ $service -> id }}">
                            <label for="{{ $service -> id }}"><i class="{{ $service->fa_icon }} mx-2"></i> {{ $service -> name }}</label><br>
                        @empty
                            <p>Non abbiamo nessun servizio attivo al momento! :(</p>
                        @endforelse
                    </div>
                </div>

                <!-- Invio modulo -->
                <div class="form-group">
                    <input id="crea" type="submit" class="crea btn btn-primary my-3" value="Crea">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
