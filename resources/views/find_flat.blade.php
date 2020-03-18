@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">Appartamenti trovati</h1>
                <div class="fuzzy-find">

                </div>
            </div>
        </div>
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
