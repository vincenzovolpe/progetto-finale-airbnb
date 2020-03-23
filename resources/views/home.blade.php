@php
    // Creo un array nella session per memorizzare le pagine visitate dagli utenti e memorizzo all'interno l'url della pagina corrente visitata
    session()->push('clicked_url', url()->current());
@endphp

@extends('layouts.app')

@section('searchbox')
    <div class="container">
        <div id="homeLeftBox" class="row">
            <div class="col-lg-6 card border-light shadow">
                <form class="form" action="{{ route('flat.find') }}" method="POST" role="form" autocomplete="off">
                    @csrf
                    <div class="form-group fuzzy-home">
                        <h2>Prenota alloggi fantastici.</h2>
                        <h6>Dove</h6>
                    </div>
                    <div class="form-group">
                        <button id="btn_home" type="submit" class="btn btn-success btn-lg float-right">Cerca</button>
                    </div>
                    <input id="searchHome" type="text" name="address_home" hidden>
                    <input id="latNumberHome" type="text" name="lat" hidden>
                    <input id="lonNumberHome" type="text" name="lon" hidden>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        <div id="home-sponsored" class="row">
            <h2 class="text-center">Appartamenti in primo piano</h2>
                <!-- Card package -->
            <div id="sponsored" class="card-columns">
                @if(isset($flat_sponsored) && $flat_sponsored->count())
                    @foreach ($flat_sponsored as $flat)
                        <div class="card">
                            <img class="card-img" src="{{asset('storage/' .$flat->img_uri)}}" alt="">
                            <div class="card-img-overlay">
                                <i class="fas fa-star"></i>
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
                    @endforeach
                @else
                    <p>Non ci sono appartamenti sponsorizzati</p>
                @endif
            </div>
        </div>
        <div id="home-not-sponsored" class="row">
            <h2 class="text-center">Appartamenti</h2>
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
        </div>
    </div>
@endsection
