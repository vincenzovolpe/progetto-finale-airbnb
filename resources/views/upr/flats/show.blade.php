@extends("layouts.upr")
@section("content")
<div class="container">
    <div class="row">
        <h1>FLAT DETAILS</h1>
        <a class="btn btn-info" href="{{ route('upr.flats.index') }}">Back to index!</a>
    </div>
    <div class="row">
        <div class="col">
            <ul class="list-group">
                <li class="list-group-item list-group-item-dark">
                    TITLE: {{ $flat->title }}
                </li>
                <li class="list-group-item list-group-item-dark">
                    NUMBER OF ROOMS: {{ $flat->room_qty }}
                </li>
                <li class="list-group-item list-group-item-dark">
                    NUMBER OF BEDS: {{ $flat->bed_qty }}
                </li>
                <li class="list-group-item list-group-item-dark">
                    NUMBER OF BATHS: {{ $flat->bath_qty }}
                </li>
                <li class="list-group-item list-group-item-dark">
                    SQUARE METERS: {{ $flat->sq_meters }}
                </li>
                <li class="list-group-item list-group-item-dark">
                    ADDRESS: {{ $flat->address }}
                </li>
                <li class="list-group-item list-group-item-dark">
                    LATITUDE: {{ $flat->lat }}
                </li>
                <li class="list-group-item list-group-item-dark">
                    LONGITUDE: {{ $flat->lon }}
                </li>
                <li class="list-group-item list-group-item-dark">
                    IS ACTIVE ON-SITE?: {{ $flat->active }}
                </li>
                <li class="list-group-item list-group-item-dark">
                    CREATED: {{ $flat->created_at }}
                </li>
                <li class="list-group-item list-group-item-dark">
                    UPDATED: {{ $flat->updated_at }}
                </li>
            </ul>
            <ul class="list-group">
                <li class="list-group-item">
                    <strong>SERVIZI ATTIVI:</strong>
                </li>
                @forelse($service as $single_service)
                <li class="list-group-item">
                    {{ $single_service }}
                </li>
                @empty
                <li class="list-group-item">
                    Nessun servizio attivo al momento! :(
                </li>
                @endforelse
            </ul>
        </div>
        <div class="col">
            <h4>TITLE = {{ $flat->title }}</h4>
            <img class="card-img" src="{{asset('storage/' .$flat->img_uri)}}" alt="">
        </div>
    </div>
</div>
@endsection
