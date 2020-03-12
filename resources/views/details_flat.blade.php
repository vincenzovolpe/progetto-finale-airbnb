@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Dettaglio Appartamento</h1>
        <div class="row">
            <div class="col-12">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img class="d-block w-100" src="{{asset('storage/' .$flat->img_uri)}}" alt="First slide">
                  </div>
                </div>
            </div>
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
            </div>
        </div>
    </br>
        <div class="row">
            <div class="col-6">
                <h2>{{$flat->title}}</h2>
                <p>{{$flat->address}}</p>
            </br>
            </br>
                <h4>{{$flat->room_qty}} stanze {{$flat->bed_qty}} letti {{$flat->bath_qty}} bagni</h4>
            </br>
                <h5>Elenco servizi</h5>
            </div>
            <div class="col-6">
                <!-- form user info -->
                    <div class="card card-outline-secondary">
                        <div class="card-header">
                            <h3 class="mb-0">Contatta il propietario</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" role="form" autocomplete="off">
                                <fieldset>
                                    <label for="name2" class="mb-0">Name</label>
                                    <div class="row mb-1">
                                        <div class="col-lg-12">
                                            <input type="text" name="name2" id="name2" class="form-control" required="">
                                        </div>
                                    </div>
                                    <label for="email2" class="mb-0">Email</label>
                                    <div class="row mb-1">
                                        <div class="col-lg-12">
                                            <input type="text" name="email2" id="email2" class="form-control" required="">
                                        </div>
                                    </div>
                                    <label for="message2" class="mb-0">Message</label>
                                    <div class="row mb-1">
                                        <div class="col-lg-12">
                                            <textarea rows="6" name="message2" id="message2" class="form-control" required=""></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-danger btn-lg float-left">Invia messaggio</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                    <!-- /form user info -->
            </div>
        </div>
    </div>
@endsection
