@extends("layouts.upr")
@section("content")
<div id="show-details" class="container mb-5">
    <div class="row my-5">
        <div class="col-lg-12">
            <h1 class="float-left">Dettagli dell'appartamento</h1>
            <a class="btn btn-info float-right" href="{{ route('upr.flats.index') }}">torna indietro</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <h3>{{ $flat->title }}</h3>
            <h5>{{ $flat->address }}</h5>
            <img class="card-img" src="{{asset('storage/' .$flat->img_uri)}}" alt="flat picture">
        </div>
        <div class="col-lg-6">
            <h5>Caratteristiche</h5>
            <table class="table table-striped table-bordered">
                <tbody>
                    <tr>
                        <td><i class="fas fa-door-open"></i></td>
                        <td>Stanze</td>
                        <td>{{ $flat->room_qty }}</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-bed"></i></td>
                        <td>Letti</td>
                        <td>{{ $flat->bed_qty }}</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-bath"></i></td>
                        <td>Bagni</td>
                        <td>{{ $flat->bath_qty }}</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-ruler"></i></td>
                        <td>Metri quadri</td>
                        <td>{{ $flat->sq_meters }}</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-globe"></i></td>
                        <td>Latitudine</td>
                        <td>{{ $flat->lat }}</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-globe"></i></td>
                        <td>Longitudine</td>
                        <td>{{ $flat->lon }}</td>
                    </tr>
                    <tr>
                        <td><i class="far fa-check-circle"></i></td>
                        <td>Attivo?</td>
                        <td>{{ $flat->active }}</td>
                    </tr>
                    <tr>
                        <td><i class="far fa-plus-square"></i></td>
                        <td>data inserimento</td>
                        <td>{{ $flat->created_at }}</td>
                    </tr>
                    <tr>
                        <td><i class="far fa-edit"></i></td>
                        <td>ultima modifica</td>
                        <td>{{ $flat->updated_at }}</td>
                    </tr>
                </tbody>
            </table>
            <h5 class="mt-4">Servizi disponibili</h5>
            <table class="table table-striped table-bordered">
                <tbody>
                    @forelse($flat->services as $service)
                    <tr>
                        <td><i class="{{ $service->fa_icon }}"></i></td>
                        <td>{{ $service->name }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td>
                            Nessun servizio attivo al momento! :(
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
