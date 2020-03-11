@extends("layouts.upr")
@section("content")
<h1>INDEX (LIST OF FLATS)</h1>
<ul class="list-group">
    @forelse($flats as $flat)
        <li class="list-group-item list-group-item-dark">
            <div class="container">
                <div class="row">
                    <div class="col">
                    </div>
                    <div class="col">
                        <!-- Link at show view -->
                        <p><strong>TITLE:</strong> {{ $flat->title }}</p>
                        <p><strong>ADDRESS:</strong> {{ $flat->address }}</p>
                        <a class="btn btn-info" href="{{ route('upr.flats.show' , ['flat' => $flat->id]) }}">SHOW DETAILS</a>

                        <!-- Link at update view -->

                    </div>
                </div>
            </div>
        </li>
    @empty
        <li class="list-group-item list-group-item-warning"> Nessun appartamento! </li>
    @endforelse
    </ul>
</div>
@endsection
