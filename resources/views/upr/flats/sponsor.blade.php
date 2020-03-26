@extends("layouts.upr")
@section("content")
<div id="sponsor-page" class="container my-5">
    <div class="row mt-5">
        <div class="col-lg-12">
            <h1 class="float-left">Scegli la durata della sponsorizzazione</h1>
            <a class="btn btn-info float-right" href="{{ route('upr.flats.index') }}">Back to index!</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h4>Appartamento: <strong>{{ $flat->title }}</strong></h4>
            <h5>Sito in: <strong>{{ $flat->address }}</strong></h5>
        </div>
        <div class="col-md-6">
            <!-- Inserire qui una lista delle opzioni di sponsorizzazione: -->
            <table class="table table-bordered my-5">
                <tbody>
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center">Durata</th>
                            <th class="text-center">costo</th>
                            <th></th>
                        </tr>
                    </thead>
                    @forelse($sponsor as $single_sponsor)
                        <tr>
                            <td class="text-center">{{ $single_sponsor->hours }} ore</td>
                            <td class="text-center">{{ $single_sponsor->price }}€</td>
                            <td class="text-center">
                                <a class="btn btn-success" href="{{ route('upr.payment.index', ['id' => $flat->id, 'sponsor_id' => $single_sponsor->id]) }}">paga ora</a>
                            </td>
                        </tr>
                    @empty
                    <p>Non abbiamo nessun servizio di sponsorizzazione attivo al momento! :(</p>
                    @endforelse
                </tbody>
            </table>
            {{-- @forelse($sponsor as $single_sponsor)
            <p>
                Sponsorizza per <strong>{{ $single_sponsor->hours }}</strong> ore, alla modica cifra di:<strong>{{ $single_sponsor->price }}€</strong>!
                <a class="btn btn-success float-right" href="{{ route('upr.payment.index', ['id' => $flat->id, 'sponsor_id' => $single_sponsor->id]) }}">Effettua il pagamento</a>
            </p>
            @empty
            <p>Non abbiamo nessun servizio di sponsorizzazione attivo al momento! :(</p>
            @endforelse --}}
        </div>
    </div>
</div>
@endsection
