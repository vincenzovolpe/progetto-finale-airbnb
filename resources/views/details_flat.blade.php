@php
    // Creo un array nella session per memorizzare le pagine visitate dagli utenti e memorizzo all'interno l'url della pagina corrente visitata
    session()->push('clicked_url', url()->current());

@endphp

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
    </br>
        <div class="row">
            <div class="col-6">
                <h2>{{$flat->title}}</h2>
                <p>{{$flat->address}}</p>
            </br>
            </br>
                <h4>{{$flat->room_qty}} stanze {{$flat->bed_qty}} letti {{$flat->bath_qty}} bagni</h4>
            </br>
                <h5>Elenco servizi</h5>
            </div>
            <div class="col-6">
                <!-- form user info -->
                    <div class="card card-outline-secondary">
                        <div class="card-header">
                            <h3 class="mb-0">Contatta il propietario</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" action="{{route('send.mail')}}" method="post" role="form" autocomplete="on">
                            @csrf
                                <fieldset
                                    @if (Auth::user() && Auth::user()->id == $flat->user->id)
                                        disabled>
                                    @else
                                        >
                                    @endif
                                    <label for="email" class="mb-0">Email</label>
                                    <div class="row mb-1">
                                        <div class="col-lg-12">
                                                <input type="text" name="msg_email" id="msg_email" class="form-control @error('msg_email') is-invalid @enderror"
                                                @if (Auth::user() && Auth::user()->id != $flat->user->id)
                                                    value="{{Auth::user()->email}}" required="">
                                                @else
                                                    >
                                                @endif

                                                @error('msg_email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                    </div>
                                    <label for="message" class="mb-0">Messaggio</label>
                                    <div class="row mb-1">
                                        <div class="col-lg-12">
                                            <textarea rows="6" name="text_msg" id="text_msg" class="form-control @error('text_msg') is-invalid @enderror" required="">{{ old('text_msg') }}</textarea>

                                                @error('text_msg')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                    </div>
                                    <input type="text" name="flat_id" value="{{$flat->id}}" hidden>
                                    <input type="text" name="email_owner" value="{{$flat->user->email}}" hidden>
                                    <input type="text" name="name_owner" value="{{$flat->user->name}}" hidden>
                                    <input type="text" name="flat_title" value="{{$flat->title}}" hidden>
                                    <input id="latNumber" type="text" name="lon" value="{{$flat->lon}}" hidden>
                                    <input id="lonNumber" type="text" name="lat" value="{{$flat->lat}}" hidden>
                                    <button type="submit" class="btn btn-danger btn-lg float-left">Invia messaggio</button>
                                </fieldset>

                            </form>
                        </div>
                    </div>
                    <!-- /form user info -->
            </div>
        </div>
        <div id='map' class='full-map'>

        </div>
    </div>
@endsection
