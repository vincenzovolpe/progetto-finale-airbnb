@extends("layouts.upr")
@section("content")
<!-- Commento di prova -->
<!-- secondo commento di prova -->
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Scegli le opzioni di sponsorizzazione:</h1>
            <p>
                Appartamento: <strong>{{ $flat->title }}</strong><br>
                Sito in: <strong>{{ $flat->address }}</strong>
            </p>
            <a class="btn btn-info" href="{{ route('upr.flats.index') }}">Back to index!</a>
        </div>
        <div class="col">
            <!-- Inserire qui una lista delle opzioni di sponsorizzazione: -->
            @forelse($sponsor as $single_sponsor)
            <p>
                Sponsorizza per <strong>{{ $single_sponsor->hours }}</strong> ore, alla modica cifra di:<strong>{{ $single_sponsor->price }}€</strong>!
                <a class="btn btn-success float-right" href="{{ route('upr.payment.index', ['id' => $flat->id, 'sponsor_id' => $single_sponsor->id]) }}">Effettua il pagamento</a>
            </p>
            @empty
            <p>Non abbiamo nessun servizio di sponsorizzazione attivo al momento! :(</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
