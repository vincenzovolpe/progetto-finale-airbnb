// Importazione riferimenti mappe Tom Tom, dei services e del plugin di Ricerca con autocompletamento
import tt from '@tomtom-international/web-sdk-maps';
import { services } from '@tomtom-international/web-sdk-services';
import SearchBox from '@tomtom-international/web-sdk-plugin-searchbox';

// per avere jQuery
var $ = require('jquery');

// per avere Moment.js
var moment = require('moment');

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app',
// });


// Options for the fuzzySearch service
var searchOptions = {
    key: 'Y2cMr97XoBZZKKVXgUS844gofkPiZFnA',
    language: 'it-IT',
    limit: 5
};


// Options for the autocomplete service
var autocompleteOptions = {
    key: 'Y2cMr97XoBZZKKVXgUS844gofkPiZFnA',
    language: 'it-IT' };

var searchBoxOptions = {
    minNumberOfCharacters: 0,
    searchOptions: searchOptions,
    autocompleteOptions: autocompleteOptions
};

// creazione dell'oggetto searchBox generico
const ttSearchBox = new SearchBox(services, searchBoxOptions);

// document.querySelector('.fuzzy').appendChild(ttSearchBox.getSearchBoxHTML());


$(document).ready(function(){
    // inserisco il placeholder in tutte le searchbox
    $(".tt-search-box-input").attr("placeholder", "Ovunque");

    // Variabili da passare a createMap
    var lonNumber = $('#lonNumber').val();
    var latNumber = $('#latNumber').val();
    var title = $('#title').text();
    var address = $('#address').text();

    // nella searchbox della edit valorizzo il campo col valore precedente
    $("#address-edit").find(".tt-search-box-input").val(address);
    $(".tt-search-box-input").attr('name', 'address');

    // Chiamo la funzione che mi crea la mappa nella pagina di dettaglio
    var href = window.location.href;
    // Creo la mappa solo quando mi trovo  all'interno della pagina di dettaglio dell'appartamento
    if(href.indexOf('/flats/details') > -1)
    {
            createMap(lonNumber, latNumber, title, address);
    }

    //-----FORM VALIDATION BOOTSTRAP-----------//
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');
          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();

    // Funzione di validazione del nome e cognome in fase di registrazione
    function validation(parametro,valido,invalido){
        $(parametro).keyup(function(){
            var value = ($(parametro).val());
            // console.log(value);
            if (value.length >= 3 && value.length <= 20) {
                $(valido).show();
                $(invalido).hide();
                $(parametro).addClass('is-valid');
                $(parametro).removeClass('is-invalid');
                // $('.needs-validation').addClass('was-validated');
            }else{
                $(valido).hide();
                $(invalido).show();
                $(parametro).addClass('is-invalid');
                $(parametro).removeClass('is-valid');
            }
            return parametro,valido,invalido;
        })

    }
    // Validazione Nome e cognome in fase di registrazione
    validation('#name','.name.valid-feedback','.name.invalid-feedback');
    validation('#surname','.surname.valid-feedback','.surname.invalid-feedback');

    // validation delle date in fase di registrazione

    $('#date_of_birth').keyup(function(){
      var date_of_birth = $('#date_of_birth').val();
      var dataUtente = moment(date_of_birth);
      // console.log(dataUtente);
      var date = moment().subtract(18, 'years');
      // console.log(date_of_birth);
      if (dataUtente < date) {
          // console.log('ok');
          $('.date.valid-feedback').show();
          $('.date.invalid-feedback').hide();
          $('#date_of_birth').addClass('is-valid');
          $('#date_of_birth').removeClass('is-invalid');
      }else{
          // console.log('no');
          $('.date.invalid-feedback').show();
          $('.date.valid-feedback').hide();
          $('#date_of_birth').addClass('is-invalid');
          $('#date_of_birth').removeClass('is-valid');
      }
  });
// validazioni email
    function validationEmail(mail,valido,invalido){
        $(mail).keyup(function(){
            var email = $(mail).val();
            var chioccia = (email.indexOf('@')+ 1);
            var point = (email.indexOf('.')+1);
            var point2 = (email.indexOf('.',point)+1);
            // console.log(chioccia);
            // console.log(point);
            // console.log(point2);
            if ( chioccia > point && point2 > chioccia) {
                // console.log('ok');
                $(valido).show();
                $(invalido).hide();
                $(mail).addClass('is-valid');
                $(mail).removeClass('is-invalid');
            }else if(chioccia >= 1 && chioccia < point){
                // console.log('ok');
                $(valido).show();
                $(invalido).hide();
                $(mail).addClass('is-valid');
                $(mail).removeClass('is-invalid');
            }else{
                // console.log('no');
                $(invalido).show();
                $(valido).hide();
                $(mail).addClass('is-invalid');
                $(mail).removeClass('is-valid');
            }

            return mail,valido,invalido;
        })
    };
    // Validazione mail in fase di registrazione e invio messaggio
    validationEmail('#email','.mail.valid-feedback','.mail.invalid-feedback');
    validationEmail('#msg_email','.msg_mail.valid-feedback','.msg_mail.invalid-feedback');

//validation nella pagina del Create.blade della descrizione
    $('#title').keyup(function(){
        var titolo = $('#title').val();
        if (titolo.length >= 5) {
            $('.title.valid-feedback').show();
            $('.title.invalid-feedback').hide();
            $('#title').addClass('is-valid');
            $('#title').removeClass('is-invalid');
        }else{
            // console.log('no');
            $('.title.invalid-feedback').show();
            $('.title.valid-feedback').hide();
            $('#title').addClass('is-invalid');
            $('#title').removeClass('is-valid');
        }
    });

//Funzione di validation nella pagina del Create.blade dei numeri di bagni,letti e camere
function validationNumber(parametro,valido,invalido,){
    $(parametro).keyup(function(){
        var value = ($(parametro).val());
        // console.log(value);
        if (value >= 1 && value <= 50) {
            $(valido).show();
            $(invalido).hide();
            $(parametro).addClass('is-valid');
            $(parametro).removeClass('is-invalid');
            // $('.needs-validation').addClass('was-validated');
        }else{
            $(valido).hide();
            $(invalido).show();
            $(parametro).addClass('is-invalid');
            $(parametro).removeClass('is-valid');
        }

        return parametro,valido,invalido;
    })

}
    //validation nella pagina del Create.blade dei numeri di bagni,letti e camere
    validationNumber('#room_qty','.room_qty.valid-feedback','.room_qty.invalid-feedback');
    validationNumber('#bed_qty','.bed_qnty.valid-feedback','.bed_qnty.invalid-feedback');
    validationNumber('#bath_qty','.bath_qty.valid-feedback','.bath_qty.invalid-feedback');

    //Funzione di validation nella pagina del Create.blade dei mq
    function validationMq(parametro,valido,invalido,){
        $(parametro).keyup(function(){
            var value = ($(parametro).val());
            // console.log(value);
            if (value >= 10 && value <= 500) {
                $(valido).show();
                $(invalido).hide();
                $(parametro).addClass('is-valid');
                $(parametro).removeClass('is-invalid');
                // $('.needs-validation').addClass('was-validated');
            }else{
                $(valido).hide();
                $(invalido).show();
                $(parametro).addClass('is-invalid');
                $(parametro).removeClass('is-valid');
            }

            return parametro,valido,invalido;
        })

    }
        //validation nella pagina del Create.blade dei numeri dei Mq
        validationMq('#sq_meters','.sq_meters.valid-feedback','.sq_meters.invalid-feedback');

    // validazione grandezza immagine in create.blade
    $('#img_uri').bind('change', function() {
        var a=(this.files[0].size);
        if(a < 5000000) {
            // alert("L'immagine selezionata supera i 5MB!!!");
            $('#crea').removeClass('disabled');
            $('.img_uri.invalid-feedback').hide();
            $('.img_uri.valid-feedback').show();
            $('#crea').show();
        }else{
            $('#crea').hide();
            $('.img_uri.valid-feedback').hide();
            $('.img_uri.invalid-feedback').show();
        };
    });
});

    // Istruzioni per caricare risultati di ricerca dalla home nella pagina di ricerca
//     if(href.indexOf('/flats/find') > -1)
//     {
//         var address_search = $('#searchFind').val();
//         $(".fuzzy-find").find(".tt-search-box-input").val(address_search);
//     }
// });




// searchbox per la pag create
const searchBoxCreate = ttSearchBox.getSearchBoxHTML();
$('.fuzzy-create').append(searchBoxCreate);

// searchbox per la pag home
const searchBoxHome = ttSearchBox.getSearchBoxHTML();
$('.fuzzy-home').append(searchBoxHome);

// searchbox per la pag edit
const searchBoxEdit = ttSearchBox.getSearchBoxHTML();
$('.fuzzy-edit').append(searchBoxEdit);

// searchbox per la pag edit
const searchBoxFind = ttSearchBox.getSearchBoxHTML();
$('.fuzzy-find').append(searchBoxFind);


// ttSearchBox.on('tomtom.searchbox.resultscleared', handleResultsCleared);
// ttSearchBox.on('tomtom.searchbox.resultsfound', handleResultsFound);
//ttSearchBox.on('tomtom.searchbox.resultfocused', handleResultSelection);
ttSearchBox.on('tomtom.searchbox.resultselected', handleResultSelection);


function handleResultSelection(event) {
    if (isFuzzySearchResult(event)) {
        // Display selected result on the map
        var result = event.data.result;
        var longitudine = result.position.lng;
        var latitudine = result.position.lat;

        // coordinate per la pagina details
        $('#lat').val(latitudine);
        $('#lon').val(longitudine);

        // coordinate per la home
        $('#latNumberHome').val(latitudine);
        $('#lonNumberHome').val(longitudine);
        // indirizzo inserito nella searchbar in home (lo assegno al campo nascosto dell'indirizzo in home)
        $('#searchHome').val($('.tt-search-box-input').val());
        //console.log($('#searchHome').val());
    }
}

function isFuzzySearchResult(event) {
    return !('matches' in event.data.result);
}


function createMap(longitudine, latitudine, title, address) {

    //var roundLatLng = Formatters.roundLatLng;
    var center = [latitudine, longitudine];
    var popup = new tt.Popup({
             offset: 35
    });

    var map = tt.map({
        key: 'Y2cMr97XoBZZKKVXgUS844gofkPiZFnA',
        container: 'map',
        center: center,
        zoom: 15,
        style: 'tomtom://vector/1/basic-main',
        dragPan: !isMobileOrTablet()
    });

    map.addControl(new tt.FullscreenControl());
    map.addControl(new tt.NavigationControl());

    //Creazione del marker all'indirizzo dell'Appartamento
    var marker = new tt.Marker({
    }).setLngLat(center).addTo(map);

    popup.setHTML(title + "<br>" + address + "<br>" + latitudine + " " + longitudine);
    marker.setPopup(popup);
    //marker.togglePopup();
}
