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
                    <div class="form-group row">
                        <label for="title" class="col-md-8 col-form-label text-md-left">{{ __('Description') }}</label>
                        <div class="col-md-8">
                            <input id="title" class="form-control @error('title') is-invalid @enderror" type="text" name="title" value="{{ old('title')}}" required>
                            <div class="title valid-feedback">
                                Inserimento corretto!
                            </div>
                            <div class="title invalid-feedback">
                                Inserisci una descrizione valida - min 5 caratteri
                            </div>
                        </div>
                    </div>
                    <!-- Inserimento numero di stanze -->
                    <div class="form-group row">
                        <label for="room_qty" class="col-md-2 col-form-label text-md-left">{{ __('Number of rooms') }}</label>
                        <div class="col-md-2">
                            <input id="room_qty" class="form-control @error('room_qty') is-invalid @enderror" type="number" name="room_qty" value="{{ old('room_qty')}}" required>
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
                        <label for="bed_qty" class="col-md-2 col-form-label text-md-left">{{ __('Number of beds') }}</label>
                        <div class="col-md-2">
                            <input id="bed_qty" class="form-control @error('bed_qty') is-invalid @enderror" type="number" name="bed_qty" value="{{ old('bed_qty')}}" required>
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
                        <label for="bath_qty" class="col-md-2 col-form-label text-md-left">{{ __('Number of baths') }}</label>
                        <div class="col-md-2">
                            <input id="bath_qty" class="form-control @error('bath_qty') is-invalid @enderror" type="number" name="bath_qty" value="{{ old('bath_qty')}}" required>
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
                        <label for="sq_meters" class="col-md-2 col-form-label text-md-left">{{ __('Square meters') }}</label>
                        <div class="col-md-2">
                            <input id="sq_meters" class="form-control @error('sq_meters') is-invalid @enderror" type="number" name="sq_meters" value="{{ old('sq_meters')}}" required>
                            <div class="sq_meters valid-feedback">
                                Inserimento corretto!
                            </div>
                            <div class="sq_meters invalid-feedback">
                                Inserisci un valore valido compreso tra 10 e 500
                            </div>
                        </div>
                    </div>

                    <!-- searchbox indirizzo collegato a tomtom -->
                    <div class="fuzzy-create">
                        {{-- <label for="">Dove</label> --}}
                        {{-- <input type="text" class="form-control" id="inputName" placeholder="Ovunque" required=""> --}}
                    </div>
                    {{-- <label for="address" class="col-md-8 col-form-label text-md-right">{{ __('Adress') }}</label>
                    <input id="address" type="text" name="address" value="{{ old('address')}}" required> --}}

                    <!-- Inserimento latitudine recuperato da API tomtom -->
                    <input id="lat" type="text" name="lat" hidden>
                    <!-- Inserimento longitudine recuperato da API tomtom -->
                    <input id="lon" type="text" name="lon" hidden>
                    <!-- Inserimento active -->
                    <br>
                    <input type="radio" id="active" name="active" value="1" required>
                    <label for="active" class="col-form-label text-md-right">{{ __('Visualizza su sito!') }}</label>
                    <br>
                    <input type="radio" id="active" name="active" value="0" required>
                    <label for="active" class="col-form-label text-md-right">{{ __('Non visualizzare su sito!') }}</label>
                    <br>

                    <!-- Inserimento uri immagine -->
                    <label for="img_uri">Upload your best picture for this flat...</label>
                    <input id="img_uri" type="file" class="form-control-file @error('img_uri') is-invalid @enderror" name="img_uri">
                    <div class="img_uri valid-feedback">
                        Inserimento corretto!
                    </div>
                    <div class="img_uri invalid-feedback">
                        Inserisci un'immagine non superiore ai 5MB
                    </div>
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
                        <input id="crea" type="submit" class="crea btn btn-primary" value="Crea">
                    </div>
                </form>
                <a class="btn btn-info" href="{{ route('upr.flats.index') }}">Back to index!</a>
            </div>
        </div>
    </div>
@endsection
