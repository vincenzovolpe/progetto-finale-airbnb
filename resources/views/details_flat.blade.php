@php
    // Creo un array nella session per memorizzare le pagine visitate dagli utenti e memorizzo all'interno l'url della pagina corrente visitata
    session()->push('clicked_url', url()->current());

@endphp

@extends('layouts.short')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        @if (session('status'))
            <script>
            Swal.fire(
                'Inviato!',
                'Messaggio inviato correttamente',
                'success'
            )
            </script>
        @endif
    <div id="flat-det" class="container">
        <h2 id="title" class="text-center">{{$flat->title}}</h2>
        <div class="row">
            <div class="col-12">
                <img class="d-block w-100" src="{{asset('storage/' .$flat->img_uri)}}" alt="flat picture">
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <h3>Dettagli dell'appartamento</h3>
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td><i class="fas fa-map-marker-alt"></i></td>
                            <td>Indirizzo</td>
                            <td id="address">{{$flat->address}}</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-door-open"></i></td>
                            <td>Numero di stanze</td>
                            <td>{{$flat->room_qty}}</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-bed"></i></td>
                            <td>Numero di letti</td>
                            <td>{{$flat->bed_qty}}</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-bath"></i></td>
                            <td>Numero di bagni</td>
                            <td>{{$flat->bath_qty}}</td>
                        </tr>
                    </tbody>
                  </table>
                @if(($flat->services)->isNotEmpty())
                    <h3>Elenco servizi</h3>
                        @foreach ($flat->services as $service)
                            <i class="{{ $service->fa_icon }}"></i>  {{$service->name}} </br>
                        @endforeach
                @endif
            </div>
            <div class="col-6">
            <!-- form user info -->
                <div class="card card-outline-secondary">
                    <div class="card-header">
                    @if (Auth::user() && Auth::user()->id == $flat->user->id)
                            <h3 class="mb-0">Sei il propietario di questo appartamento</h3>
                    @else
                            <h3 class="mb-0">Contatta il propietario</h3>
                    @endif
                    </div>
                    @if (Auth::user() && Auth::user()->id == $flat->user->id)
                            <div class="card-body invisible">
                    @else
                    <div class="card-body">
                    @endif
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
                                                value="{{Auth::user()->email}}">
                                            @else
                                                >
                                            @endif
                                            <div class="msg_mail valid-feedback">
                                                Inserimento corretto!
                                            </div>
                                            <div class="msg_mail invalid-feedback">
                                                Inserisci una mail corretta
                                            </div>

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
                                        <textarea rows="6" name="text_msg" id="text_msg" class="form-control @error('text_msg') is-invalid @enderror" required>{{ old('text_msg') }}</textarea>
                                            <div class="text_msg valid-feedback">
                                                Inserimento corretto!
                                            </div>
                                            <div class="text_msg invalid-feedback">
                                                Inserisci un numero minimo di 10 caratteri
                                            </div>
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
                    {{-- @endif --}}
                    </div>
                </div>
                <!-- /form user info -->
            </div>
        </div>
        <br>
        <h3>Mappa dislocazione appartamento</h3>
        <div id='map' class='full-map'>

        </div>
    </div>
@endsection
