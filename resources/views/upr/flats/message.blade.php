@extends("layouts.upr")
@section("content")
    <div id="upr-msg" class="container my-5">
        <h1 class="my-5">Messaggi ricevuti</h1>
        <div class="row">
            <div class="col-lg-8">
                @if ($messages->count() > 0)
                    @foreach ($messages as $message)
                        <div class="shadow card my-5">
                            <div class="card-body">
                                <table class="table table-light table-bordered">
                                    <tbody>
                                        <tr class="d-flex">
                                            <td class="col-3 text-right">Messaggio ricevuto da</td>
                                            <td class="col-1 text-center"><i class="far fa-envelope-open"></i></td>
                                            <td class="col-8"> <a href="mailto:{{$message->msg_email}}">{{$message->msg_email}}</a></td>
                                        </tr>
                                        <tr class="d-flex">
                                            <td class="col-3 text-right">Appartamento</td>
                                            <td class="col-1 text-center"><i class="fas fa-home"></i></td>
                                            <td class="col-8">{{$message->flat->title}}</td>
                                        </tr>
                                        <tr class="d-flex">
                                            <td class="col-3 text-right">Data Ricezione</td>
                                            <td class="col-1 text-center"><i class="far fa-calendar-alt"></i></td>
                                            <td class="col-8">{{$message->created_at}}</td>
                                        </tr>
                                        <tr class="d-flex">
                                            <td class="col-3 text-right">Testo del messaggio</td>
                                            <td class="col-1 text-center"><i class="far fa-file-alt"></i></td>
                                            <td class="col-8 table-success">{{$message->text_msg}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="my-5">Non hai ricevuto alcun messaggio</p>
                @endif
            </div>
        </div>
    </div>
@endsection
