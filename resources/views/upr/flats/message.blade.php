@extends("layouts.upr")
@section("content")
    <div class="container">
        <h1>Pagina dei messaggi</h1>
        <div class="row">
            <div class="col-12">
                @if ($messages->count() > 0)
                    @foreach ($messages as $message)
                        <ul>
                            <li>
                                <p>Messaggio ricevuto da: {{$message->msg_email}}</p>
                                <p>Appartamento: {{$message->flat->title}}</p>
                                <p>Data Ricezione: {{$message->created_at}}</p>
                                <p>Testo del messaggio: {{$message->text_msg}}</p>
                            </li>
                        </ul>
                    @endforeach
                @else
                    Non hai ricevuto alcun messaggio
                @endif
            </div>
        </div>
    </div>
@endsection
