@php
    // Creo un array nella session per memorizzare le pagine visitate dagli utenti e memorizzo all'interno l'url della pagina corrente visitata
    session()->push('clicked_url', url()->current());
@endphp

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">HomePage Pubblica</h1>
        <div class="row">
            <div class="col-6">
                    <div class="card card-outline-secondary">
                        <div class="card-header">
                            <h3 class="mb-0">Ricerca appartamenti unici</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" action="{{ route('flat.find') }}" method="POST" role="form" autocomplete="off">
                                @csrf
                                <div class="fuzzy-home">
                                    <label for="">Dove</label>
                                    {{-- <input type="text" class="form-control" id="inputName" placeholder="Ovunque" required=""> --}}
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-danger btn-lg float-right">Cerca</button>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</br>
    <div class="container">
        <h2 class="text-center">Appartamenti in primo piano</h2>
            <!-- Card package -->
        <div id="sponsored" class="card-columns">
            @if(isset($flat_sponsored) && $flat_sponsored->count())
                @foreach ($flat_sponsored as $flat)
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
                @endforeach
            @else
                <p>Non ci sono appartamenti sponsorizzati</p>
            @endif
        </div>
    </br>
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
@endsection
