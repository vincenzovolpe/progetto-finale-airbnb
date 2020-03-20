@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div id="flat_search">
                    <h1 class="text-center">Ricerca avanzata appartamenti</h1>
                    <div class="fuzzy-find">

                    </div>
                    <input id="searchFind" type="text" name="address_search" value="{{ $address }}" hidden>
                    <input id="latNumberFind" type="text" name="lat" value="{{ $lat }}" hidden>
                    <input id="lonNumberFind" type="text" name="lon" value="{{ $lon }}" hidden>
                    {{-- <input id="distanceFind" type="text" name="distance" value="{{ $distance }}" hidden>
                    <input id="roomsFind" type="text" name="rooms" value="{{ $rooms }}" hidden>
                    <input id="bedsFind" type="text" name="beds" value="{{ $beds }}" hidden> --}}

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
                    @foreach ($services as $service)
                        <input type="checkbox" id="{{$service->id}}" name="check_services" value="{{$service->id}}">
                        <label for="{{$service->name}}"></label>{{$service->name}}<br>
                    @endforeach

                    <button id="btn_find" class="btn btn-danger btn-lg float-right" type="button">Cerca</button>
                </div>
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-12">

            </div>
        </div> --}}
        <div class="row">
            <!-- Card package -->
            <div id="card_container" class="card-columns">
                {{-- Appendo il contenuto del template handlebars --}}
            </div>
            <!-- Card package -->
        </div>

    </div>

    <script id="card_template" type="text/x-handlebars-template">
        <div class="card">
            <img class="card-img" src="{{asset('storage/')}}/@{{ img_uri }}" alt="">
            <div class="card-img-overlay">
                <a href="#" class="btn btn-light btn-sm"></a>
            </div>
            <div class="card-body">
                <h4 class="card-title">@{{ title }}</h4>
                {{-- <p class="card-text">Propietario: {{$flat->user->name}}</p> --}}
                <a class="btn btn-danger stretched-link" style="position: relative;" href="{{ url('flats/details/')}}/@{{ flat_details }}">Vedi Dettagli</a>

            </div>
        </div>
    </script>
@endsection
