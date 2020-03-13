@extends("layouts.upr")
@section("content")
    <div class="container">
        <h1>Pagina dei messaggi</h1>
        <div class="row">
            <div class="col-12">
                @if ($messages->count() > 0)
                    @foreach ($messages as $message)
                        <ul>
                            <li>Messaggio ricevuto da: {{$message->msg_email}}
                                <p>{{$message->text_msg}}</p>
                            </li>
                        </ul>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
