@extends("layouts.upr")
@section("content")
<div class="container">
    <h1>CREATE FLAT</h1>
    <p>Riempi tutti i campi del form per inserire un nuovo appartamento.</p>
        <div class="row">
            <div class="col-md-10">
                {{-- Umberto:Imposto un ciclo per mostare gli errori avvenuti in fase di compilazione del form --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('upr.flats.store') }}" enctype="multipart/form-data">
                    @csrf
                    <!-- Inserimento titolo(descrizione) -->
                    <label for="title" class="col-md-8 col-form-label text-md-right">{{ __('Description') }}</label>
                    <input id="title" class="form-control" type="text" name="title" value="{{ old('title')}}" required>
                    <!-- Inserimento numero di stanze -->
                    <label for="room_qty" class="col-md-8 col-form-label text-md-right">{{ __('Number of rooms') }}</label>
                    <input id="room_qty" type="number" name="room_qty" value="{{ old('room_qty')}}" required>
                    <!-- Inserimento numero di letti -->
                    <label for="bed_qty" class="col-md-8 col-form-label text-md-right">{{ __('Number of beds') }}</label>
                    <input id="bed_qty" type="number" name="bed_qty" value="{{ old('bed_qty')}}" required>
                    <!-- Inserimento numero di bagni -->
                    <label for="bath_qty" class="col-md-8 col-form-label text-md-right">{{ __('Number of baths') }}</label>
                    <input id="bath_qty" type="number" name="bath_qty" value="{{ old('bath_qty')}}" required>
                    <!-- Inserimento metri quadri -->
                    <label for="sq_meters" class="col-md-8 col-form-label text-md-right">{{ __('Square meters') }}</label>
                    <input id="sq_meters" type="number" name="sq_meters" value="{{ old('sq_meters')}}" required>
                    <!-- Inserimento indirizzo -->
                    <label for="address" class="col-md-8 col-form-label text-md-right">{{ __('Address') }}</label>
                    <input id="address" type="text" name="address" value="{{ old('address')}}" required>
                    <!-- Inserimento lat -->
                    <label for="lat" class="col-md-8 col-form-label text-md-right">{{ __('Latitude') }}</label>
                    <input id="lat" type="number" name="lat" required value="{{ old('lat')}}">
                    <!-- Inserimento lon -->
                    <label for="lon" class="col-md-8 col-form-label text-md-right">{{ __('Longitude') }}</label>
                    <input id="lon" type="number" name="lon" required value="{{ old('lon')}}">
                    <!-- Inserimento active (per ora) -->
                    <label for="active" class="col-md-8 col-form-label text-md-right">{{ __('active') }}</label>
                    <input id="active" type="number" name="active" value="{{ old('active')}}" required>
                    <!-- Inserimento uri immagine -->
                    <label for="img_uri">Upload your best picture for this flat...</label>
                    <input id="img_uri" type="file" class="form-control-file" name="img_uri" >

                    <!-- Invio modulo -->
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Crea">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
