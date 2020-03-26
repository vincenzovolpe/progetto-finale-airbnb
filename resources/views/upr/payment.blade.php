@extends("layouts.upr")
@section("content")
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

  <div class="container">
     <div class="row">
       <div class="col-md-6 mx-auto">
         <div id="dropin-container"></div>
         <button id="submit-button">Invia Pagamento</button>
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
                  Swal.fire(
                      'Complimenti!',
                      'Pagamento effettuato correttamente',
                      'success'
                  ).then((result) => {
                      if (result.value) {
                          window.location.href =  "/upr/flats";
                      }
                  })
            } else {
                Swal.fire(
                    'Attenzione!',
                    'Pagamento fallito',
                    'error'
                )
            }
          }, 'json');
        });
      });
    });
  </script>
@endsection
