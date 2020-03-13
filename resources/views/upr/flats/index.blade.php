@extends("layouts.upr")
@section("content")
<div class="container">
    <h1>INDEX (LIST OF FLATS)</h1>
    <ul class="list-group">
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

                        <!-- WARNING: QUESTO FORM HA UNA ISTRUZIONE DI STILE IN LINEA! BISOGNA TOGLIERLA IN SEGUITO!!! -->

                        @csrf
                        @method('DELETE')
                        <a href="#" data-toggle="modal" data-target="#warningModal" class="btn btn-danger">Cancella questo appartamento!</a>
                        {{-- Inizio modale per la delete: --}}
                            <div id="warningModal" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Attenzione!</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Se prosegui con questa azione, non sarà possibile recuperare i dati del tuo appartamento! Desideri davvero continuare?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancella</button>
                                            <input type="submit" class="btn btn-danger" value="Continua">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- Fine modale per la delete. --}}
                    </form>
                </div>
            </div>
        </li>
        @empty
            <li class="list-group-item list-group-item-warning"> Nessun appartamento! </li>
        @endforelse
    </ul>
</div>
@endsection
