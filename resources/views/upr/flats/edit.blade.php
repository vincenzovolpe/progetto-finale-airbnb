@extends("layouts.upr")
@section("content")
<h1>EDIT FLAT DETAILS</h1>
<a class="btn btn-info" href="{{ route('upr.flats.index') }}">Back to index!</a>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <form method="POST" action="{{ route('upr.flats.update', ['flat' => $flat->id]) }}">
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
                <label for="address" class="col-md-8 col-form-label text-md-right">{{ __('Adress') }}</label>
                <input id="address" type="text" name="address" value="{{ $flat->address }}" required>
                <!-- Inserimento lat -->
                <label for="lat" class="col-md-8 col-form-label text-md-right">{{ __('Latitude') }}</label>
                <input id="lat" type="number" name="lat" value="{{ $flat->lat }}" required>
                <!-- Inserimento lon -->
                <label for="lon" class="col-md-8 col-form-label text-md-right">{{ __('Longitude') }}</label>
                <input id="lon" type="number" name="lon" value="{{ $flat->lon }}" required>
                <!-- Inserimento uri immagine -->
                <label for="img_uri" class="col-md-8 col-form-label text-md-right">{{ __('Image URI') }}</label>
                <input id="img_uri" type="text" name="img_uri" value="{{ $flat->img_uri }}" required>
                <!-- Inserimento active (per ora) -->
                <label for="active" class="col-md-8 col-form-label text-md-right">{{ __('active') }}</label>
                <input id="active" type="number" name="active" value="{{ $flat->active }}" required>

                <!-- Invio modulo -->
                <button type="submit" class="btn btn-primary">Submit changes!</button>
            </form>
        </div>
    </div>
</div>
@endsection
