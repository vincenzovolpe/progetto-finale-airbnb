@extends("layouts.upr")
@section("content")
<div class="container">
    <h1>CREATE FLAT</h1>
    <p>Riempi tutti i campi del form per inserire un nuovo appartamento.</p>
        <div class="row">
            <div class="col-md-10">
                <form method="POST" action="{{ route('upr.flats.store') }}" enctype="multipart/form-data">
                    @csrf
                    <!-- Inserimento titolo(descrizione) -->
                    <label for="title" class="col-md-8 col-form-label text-md-right">{{ __('Description') }}</label>
                    <input id="title" class="form-control" type="text" name="title" required>
                    <!-- Inserimento numero di stanze -->
                    <label for="room_qty" class="col-md-8 col-form-label text-md-right">{{ __('Number of rooms') }}</label>
                    <input id="room_qty" type="number" name="room_qty" required>
                    <!-- Inserimento numero di letti -->
                    <label for="bed_qty" class="col-md-8 col-form-label text-md-right">{{ __('Number of beds') }}</label>
                    <input id="bed_qty" type="number" name="bed_qty" required>
                    <!-- Inserimento numero di bagni -->
                    <label for="bath_qty" class="col-md-8 col-form-label text-md-right">{{ __('Number of baths') }}</label>
                    <input id="bath_qty" type="number" name="bath_qty" required>
                    <!-- Inserimento metri quadri -->
                    <label for="sq_meters" class="col-md-8 col-form-label text-md-right">{{ __('Square meters') }}</label>
                    <input id="sq_meters" type="number" name="sq_meters" required>
                    <!-- Inserimento indirizzo -->
                    <label for="address" class="col-md-8 col-form-label text-md-right">{{ __('Adress') }}</label>
                    <input id="address" type="text" name="address" required>
                    <!-- Inserimento lat -->
                    <label for="lat" class="col-md-8 col-form-label text-md-right">{{ __('Latitude') }}</label>
                    <input id="lat" type="number" name="lat" required>
                    <!-- Inserimento lon -->
                    <label for="lon" class="col-md-8 col-form-label text-md-right">{{ __('Longitude') }}</label>
                    <input id="lon" type="number" name="lon" required>
                    <!-- Inserimento active (per ora) -->
                    <label for="active" class="col-md-8 col-form-label text-md-right">{{ __('active') }}</label>
                    <input id="active" type="number" name="active" required>
                    <!-- Inserimento uri immagine -->
                    <label for="img_uri">Upload your best picture for this flat...</label>
                    <input id="img_uri" type="file" class="form-control-file" name="img_uri">
                    <!-- PARTE DEI SERVIZI: -->
                    <strong>Seleziona un qualunque numero di servizi per il tuo appartamento:</strong><br>
                    @forelse ($servizi as $service)
                        <input type="checkbox" id="{{ $service -> id }}" name="{{ $service -> name }}" value="{{ $service -> id }}">
                        <label for="{{ $service -> id }}">{{ $service -> name }}</label><br>
                    @empty
                        <p>Non abbiamo nessun servizio attivo al momento! :(</p>
                    @endforelse
                    <!-- Invio modulo -->
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Crea">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
