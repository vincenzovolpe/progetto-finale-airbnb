@extends("layouts.upr")
@section("content")
<div id="dashboard-index" class="container">
    <h1>INDEX (LIST OF FLATS)</h1>
    {{-- <ul class="list-group"> --}}
        @forelse($flats as $flat)

        <li class="list-group-item list-group-item-dark">
            <div class="row">
                <div class="col-3">
                    <img class="card-img" src="{{asset('storage/' .$flat->img_uri)}}" alt="">
                </div>
                <div class="col">

                    <p><strong>TITLE:</strong> {{ $flat->title }}</p>
                    <p><strong>ADDRESS:</strong> {{ $flat->address }}</p>
                    <!-- Vado alla view per vedere i dettagli: -->
                    <a class="btn btn-info" href="{{ route('upr.flats.show' , ['flat' => $flat->id]) }}">SHOW DETAILS</a>
                    <!-- Vado alla view di modifica: -->
                    <a class="btn btn-warning" href="{{ route('upr.flats.edit', ['flat' => $flat->id]) }}" >EDIT DETAILS</a>
                    <!--Form per la destroy: -->
                    <form class="form-inline" action="{{ route('upr.flats.destroy', ['flat' => $flat->id]) }}" method="post" style='display:inline-block'>
                        @method('DELETE')
                        @csrf
                    <input id="delete_flat" type="submit" class="btn btn-danger" data-id="{{$flat->id}}" value="Cancella questo appartamento!">

                    </form>
                    <!-- Vado alla view per la sponsorizzazione: -->
                    {{-- Occorrono un insieme di condizioni: esiste? Oppure è scaduta? --}}
                    @if (array_key_exists($flat->id,$flat_sponsored))
                        {{-- Dichiaro alcune variabili per semplificarci la vita con le date: --}}
                        @php
                            $sponsor_hours = $flat_sponsored[$flat->id]->hours;
                            $start_date = $flat_sponsored[$flat->id]->created_at;
                            $hour_diff = now()->diffInHours($start_date);
                        @endphp
                        {{-- Qui esiste, vediamo se è ancora valida: --}}
                        @if( $hour_diff <= $sponsor_hours )
                            {{-- Qui esiste ed è ancora valida: vediamo quanto dura ancora! --}}
                            <p>
                                Sponsorizzazione creata il: {{ $start_date }}, ne hai utilizzato: {{ $hour_diff }} ore su {{ $sponsor_hours }}.
                            </p>
                        @else
                            {{-- Qui esiste, ma è scaduta: consentiamo di rinnovare la sponsorizzazione. --}}
                            <p>
                                Sponsorizzazione scaduta!
                            </p>
                            <a class="btn btn-success" href="{{ route('upr.flats.sponsor', ['flat' => $flat->id])}}">Rinnova la sponsorizzazione!</a>
                        @endif
                    @else
                        {{-- Qui non esiste, quindi si può sponsorizzare! --}}
                        <p>
                            Nessuna sponsorizzazione attiva!
                        </p>
                        <a class="btn btn-success" href="{{ route('upr.flats.sponsor', ['flat' => $flat->id])}}">Sponsorizza il tuo appartamento!</a>
                    @endif
                    <!-- Messaggi ricevuti -->
                    <div class="col-12">
                        @if ($flat->messages()->count() > 0)
                                <p><strong>Messaggi ricevuti: </strong> {{$flat->messages()->count()}}</p>
                        @else
                            <p>Non sono presenti messaggi per questo appartamento</p>
                        @endif
                        <p><strong>Visite ricevute: </strong> {{$flat->view}}</p>

            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img class="card-img" src="{{asset('storage/' .$flat->img_uri)}}" alt="flat picture">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h4 class="card-title">{{ $flat->title }}</h4>
                            <p class="card-text"><i class="fas fa-map-marker-alt"></i> Indirizzo: {{ $flat->address }}</p>
                            <!-- Vado alla view per vedere i dettagli: -->
                            <a class="btn btn-success m-2" href="{{ route('upr.flats.show' , ['flat' => $flat->id]) }}">vedi dettagli</a>
                            <!-- Vado alla view di modifica: -->
                            <a class="btn btn-warning m-2" href="{{ route('upr.flats.edit', ['flat' => $flat->id]) }}" >modifica dettagli</a>
                            <!--Form per la destroy: -->
                            <form class="form-inline" action="{{ route('upr.flats.destroy', ['flat' => $flat->id]) }}" method="post" style='display:inline-block'>
                            <input type="submit" class="btn btn-danger m-2" value="ELIMINA appartamento!">
                                @csrf
                                @method('DELETE')
                            </form>
                            <!-- Vado alla view per la sponsorizzazione: -->
                            {{-- Occorrono un insieme di condizioni: esiste? Oppure è scaduta? --}}
                            @if (array_key_exists($flat->id,$flat_sponsored))
                                {{-- Dichiaro alcune variabili per semplificarci la vita con le date: --}}
                                @php
                                    $sponsor_hours = $flat_sponsored[$flat->id]->hours;
                                    $start_date = $flat_sponsored[$flat->id]->created_at;
                                    $hour_diff = now()->diffInHours($start_date);
                                @endphp
                                {{-- Qui esiste, vediamo se è ancora valida: --}}
                                @if( $hour_diff <= $sponsor_hours )
                                    {{-- Qui esiste ed è ancora valida: vediamo quanto dura ancora! --}}
                                    <p>
                                        Data sponsorizzazione: {{ $start_date }},  già utilizzato: {{ $hour_diff }} ore su {{ $sponsor_hours }}.
                                    </p>
                                @else
                                    {{-- Qui esiste, ma è scaduta: consentiamo di rinnovare la sponsorizzazione. --}}
                                    <p>
                                        Ultima sponsorizzazione terminata.
                                        <a class="btn btn-success m-2" href="{{ route('upr.flats.sponsor', ['flat' => $flat->id])}}">Rinnova subito!</a>
                                    </p>
                                @endif
                            @else
                                {{-- Qui non esiste, quindi si può sponsorizzare! --}}
                                <p>
                                    Nessuna sponsorizzazione attiva!
                                    <a class="btn btn-success m-2" href="{{ route('upr.flats.sponsor', ['flat' => $flat->id])}}">Sponsorizza adesso!</a>
                                </p>
                            @endif
                            <!-- Messaggi ricevuti -->
                            @if ($flat->messages()->count() > 0)
                                    <p>Messaggi ricevuti: {{$flat->messages()->count()}}</p>
                            @else
                                <p>Non sono presenti messaggi per questo appartamento.</p>
                            @endif
                            <p>Visite ricevute: {{$flat->view}}</p>
                        </div>

                    </div>
                </div>
            </div>
        {{-- </div> --}}

            {{-- <li class="list-group-item list-group-item-dark">
        </li> --}}
        @empty
            <li class="list-group-item list-group-item-warning"> Nessun appartamento! </li>
        @endforelse
    {{-- </ul> --}}
</div>
@endsection
