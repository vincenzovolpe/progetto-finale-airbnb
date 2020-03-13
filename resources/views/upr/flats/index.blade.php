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
                    <a class="btn btn-warning" href="{{ route('upr.flats.edit', ['flat' => $flat->id]) }}">EDIT DETAILS</a>
                    <!--Form per la destroy: -->
                    <form class="form-inline" action="{{ route('upr.flats.destroy', ['flat' => $flat->id]) }}" method="post" style='display:inline-block'>

                        <!-- WARNING: QUESTO FORM HA UNA ISTRUZIONE DI STILE IN LINEA! BISOGNA TOGLIERLA IN SEGUITO!!! -->

                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-danger" value="Delete this flat!">
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
