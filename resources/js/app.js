// Importazione riferimenti mappe Tom Tom, dei services e del plugin di Ricerca con autocompletamento
import tt from '@tomtom-international/web-sdk-maps';
import { services } from '@tomtom-international/web-sdk-services';
import SearchBox from '@tomtom-international/web-sdk-plugin-searchbox';

// per avere jQuery
var $ = require('jquery');


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

const app = new Vue({
    el: '#app',
});


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


const ttSearchBox = new SearchBox(services, searchBoxOptions);

// document.querySelector('.fuzzy').appendChild(ttSearchBox.getSearchBoxHTML());

$(document).ready(function(){
    $(".tt-search-box-input").attr("placeholder", "inserisci l'indirizzo completo");
    var address = $('#address').val();
    console.log(address);

    $("#address-edit").find(".tt-search-box-input").val(address);
    $(".tt-search-box-input").attr('name', 'address');

    // Variabili da passare a createMap
    var lonNumber = $('#lonNumber').val();
    var latNumber = $('#latNumber').val();
    var title = $('#title').text();
    var address = $('#address').text();

    // Chiamo la funzione che mi crea la mappa nella pagina di dettaglio
    createMap(lonNumber, latNumber, title, address);

    // Funzione di validazione del nome e cognome in fase di registrazione
    function validation(parametro,valido,invalido){
        $(parametro).keyup(function(){
            var value = ($(parametro).val());
            console.log(value);
            if (value.length >= 3 && value.length <= 20) {
                $(valido).show();
                $(invalido).hide();
                // $('.needs-validation').addClass('was-validated');
            }else{
                $(valido).hide();
                $(invalido).show();
            }
            return parametro,valido,invalido;
        })

    }
    // Validazione Nome e cognome in fase di registrazione
    validation('#name','.name.valid-feedback','.name.invalid-feedback');
    validation('#surname','.surname.valid-feedback','.surname.invalid-feedback');
});

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


// searchbox per la pag create
const searchBoxCreate = ttSearchBox.getSearchBoxHTML();
$('.fuzzy-create').append(searchBoxCreate);

// searchbox per la pag home
const searchBoxHome = ttSearchBox.getSearchBoxHTML();
$('.fuzzy-home').append(searchBoxHome);

// searchbox per la pag edit
const searchBoxEdit = ttSearchBox.getSearchBoxHTML();
$('.fuzzy-edit').append(searchBoxEdit);


// ttSearchBox.on('tomtom.searchbox.resultscleared', handleResultsCleared);
// ttSearchBox.on('tomtom.searchbox.resultsfound', handleResultsFound);
//ttSearchBox.on('tomtom.searchbox.resultfocused', handleResultSelection);
ttSearchBox.on('tomtom.searchbox.resultselected', handleResultSelection);


function handleResultSelection(event) {
    if (isFuzzySearchResult(event)) {
        // Display selected result on the map
        var result = event.data.result;
        //console.log(result);
        var longitudine = result.position.lng;
        var latitudine = result.position.lat;
        $('#lat').val(latitudine);
        $('#lon').val(longitudine);
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
