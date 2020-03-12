@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Dettaglio Appartamento</h1>
        <div class="row">
            <div class="col-12">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img class="d-block w-100" src="{{asset('storage/' .$flat->img_uri)}}" alt="First slide">
                  </div>
                </div>
            </div>
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
            </div>
        </div>
    </div>
@endsection
