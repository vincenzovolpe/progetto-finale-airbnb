@extends("layouts.upr")
@section("content")
<div class="col">
    <h1>FLAT DETAILS</h1>
    <h4>TITLE = {{ $flat->title }}</h4>
    <a class="btn btn-info" href="{{ route('upr.flats.index') }}">Back to index!</a>
</div>
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
            IMAGE URI: {{ $flat->img_uri }}
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
</div>

@endsection
