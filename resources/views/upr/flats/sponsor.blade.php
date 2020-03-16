@extends("layouts.upr")
@section("content")
<!-- Commento di prova -->
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
            <form method="POST" action="{{ route('upr.flats.submit') }}" enctype="multipart/form-data">
                @csrf
                @method("POST")
                <!-- Inserire qui una lista delle opzioni di sponsorizzazione: -->
                @forelse($sponsor as $single_sponsor)
                    <input type="hidden" id="{{ $flat->id }}" name="flat_id" value="{{ $flat->id }}" required>
                    <input type="radio" id="{{ $single_sponsor->id }}" name="sponsor_id" value="{{ $single_sponsor->id }}" required>
                    <label for="{{ $single_sponsor->hours }}">Sponsorizza per <strong>{{ $single_sponsor->hours }}</strong> ore, alla modica cifra di:<strong>{{ $single_sponsor->price }}</strong></label><br>
                @empty
                    <p>Non abbiamo nessun servizio di sponsorizzazione attivo al momento! :(</p>
                @endforelse
                {{-- Se esistono sponsor nel DB, mostra il pulsante di submit: --}}
                @if($sponsor->count())
                    <input type="submit" class="btn btn-success" value="Sponsorizza!">
                    {{-- Dobbiamo verificare che l'appartamento non abbia già sponsorizzazioni, prima di procedere!! --}}
                @endif
            </form>
        </div>
    </div>
</div>
@endsection
