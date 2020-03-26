@extends("layouts.upr")
@section("content")
<div class="container">
    <div class="row">
        <div class="col">

        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <!-- Qui verrà inserito il dropin di Braintree: -->
            <div id="dropin-container"></div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <!-- Verifica il pagamento: -->
            <button id="submit-button">Paga ora!</button>
            <!-- Torna in index: -->
            <a class="btn btn-info" href="{{ route('upr.flats.index') }}">Torna all'area personale!</a>
        </div>
    </div>
</div>
<script>
    var button = document.querySelector('#submit-button');
    braintree.dropin.create({
        authorization: "{{ Braintree_ClientToken::generate() }}",
        container: '#dropin-container'
    }, function (createErr, instance) {
        button.addEventListener('click', function () {
            instance.requestPaymentMethod(function (err, payload) {
                $.get('{{ route('upr.payment.process', ['id' => $id, 'sponsor_id' => $sponsor_id]) }}', {payload}, function (response) {
                    if (response.success) {
                        alert('Payment successfull!');
                    } else {
                        alert('Payment failed');
                    }
                }, 'json');
            });
        });
    });
</script>
@endsection
