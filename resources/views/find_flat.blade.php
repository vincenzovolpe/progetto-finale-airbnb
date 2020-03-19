@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">Ricerca avanzata appartamenti</h1>
                <div class="fuzzy-find">

                </div>
                <input id="searchFind" type="text" name="address_search" value="{{ $address }}" hidden>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h2 class="text-center">Filtri di ricerca</h2>
                <!-- Inserimento numero di stanze -->
                <label for="room_qty" class="col-form-label text-md-right">Numero stanze</label>
                <input id="room_qty" type="number" name="room_qty">
                <!-- Inserimento numero di letti -->
                <label for="bed_qty" class="col-form-label text-md-right">Numero Letti</label>
                <input id="bed_qty" type="number" name="bed_qty">
                <br>
                <!-- Inserimento distanza in km -->
                <label for="km_radius" class="col-form-label text-md-right">Raggio di ricerca in km</label>
                <input id="km_radius" type="range" name="km_radius" min="20" max="100" value="20" onchange="distance.value = this.value">
                <output id="distance"></output>Km
                <br>
                <!-- Servizi Aggiuntivi -->
                <label for="">Servizi opzionali</label>
                <br>
                <input type="checkbox" id="wifi" name="wifi" value="wifi">
                <label for="wifi"></label>WIFI<br>
                <input type="checkbox" id="piscina" name="piscina" value="piscina">
                <label for="piscina"></label>Piscina<br>
                <input type="checkbox" id="tv" name="tv" value="tv">
                <label for="tv"></label>TV<br>
            </div>
        </div>
        <div class="row">
            <!-- Card package -->
            <div class="card-columns">
                @forelse ($flats as $flat)
                    <div class="card">
                        <img class="card-img" src="{{asset('storage/' .$flat->img_uri)}}" alt="">
                        <div class="card-img-overlay">
                            <a href="#" class="btn btn-light btn-sm"></a>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">{{ $flat->title }}</h4>
                            {{-- <p class="card-text">Propietario: {{$flat->user->name}}</p> --}}
                            <a class="btn btn-danger stretched-link" style="position: relative;" href="{{ route('flat.details', $flat->id)}}">Vedi Dettagli</a>
                        </div>
                        <div class="card-footer text-muted d-flex justify-content-between bg-transparent border-top-0">
                            <div class="views">{{ $flat->updated_at }}
                            </div>
                            <div class="stats">
                                {{$flat->view}}
                            </div>
                        </div>
                    </div>
                @empty
                    <p>Non ci sono appartamenti</p>
                @endforelse
            </div>
            <!-- Card package -->
        </div>

    </div>

    <script type="template_flat"> type="text/x-handlebars-template">

    </script>
@endsection
