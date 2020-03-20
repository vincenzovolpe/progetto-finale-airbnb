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

    // Istruzioni per caricare risultati di ricerca dalla home nella pagina di ricerca
    // if(href.indexOf('/flats/find') > -1)
        //alert('Ho cliccato il bottone');
        var address_search = $('#searchFind').val();
        var address_edit = $('#address').val();
        $(".fuzzy-find").find(".tt-search-box-input").val(address_search);
        $(".fuzzy-edit").find(".tt-search-box-input").val(address_edit);

    // Chiamata ajax con i dati della searchbar della HomePage
    if(href.indexOf('/flats/find') > -1)
    {
        var lat = $('#latNumberFind').val();
        var lon = $('#lonNumberFind').val();
        var distance = 20;

        $.ajax({
            url: 'http://localhost:8000/api/flats',
            method: 'GET',

            data:  {
                'lat': lat,
                'lon': lon,
                'distance': distance
            },

            success: function(data) {

                    $('#card_container').empty();

                    for (var i = 0; i < data.result.length; i++) {

                        var template_html = $('#card_template').html();

                        var template_function = Handlebars.compile(template_html);

                        var variables = {
                            'img_uri': data.result[i].img_uri,
                            'title': data.result[i].title,
                            'flat_details': data.result[i].id
                        }

                        var html = template_function(variables);

                        $('.card-columns').append(html);
                    }
            }
        })
    }

    // Chiamata Ajax nella pagina Find con eventuali filtri di Ricerca
    $('#btn_find').click(function(){
        //$('#flat_search').on('click', '#btn_find', function(e) {

            //e.preventDefault();

            var lat = $('#latNumberFind').val();

            var lon = $('#lonNumberFind').val();

            var distance = $('#km_radius').val();

            var rooms = $('#room_qty').val();

            var beds = $('#bed_qty').val();


            // prendo tutte le checkbox dei Servizi
            var checkbox_value = "";
            var checkbox_count = 0;
            $("input[name=check_services]").each(function () {
                var ischecked = $(this).is(":checked");
                if (ischecked) {
                    checkbox_count++;
                    checkbox_value += $(this).val() + ",";
                }
            });
            // Tolgo l'ultima virgola nella'array delle checkbox
            var index = checkbox_value.lastIndexOf(",");
            var checkbox_selected = checkbox_value.substring(0, index) + checkbox_value.substring(index + 1);
            //var wifi = $('#1').val();
            // var ischecked = $('#1').is(":checked");
            // if (ischecked) {
            //     var wifi = $('#1').val();
            // }
            console.log(checkbox_selected);
            console.log(checkbox_count);
            //var xhr = new XMLHttpRequest();

            $.ajax({
                url: 'http://localhost:8000/api/flats',
                method: 'GET',
                // xhr: function() {
                //     return xhr;
                // },

                data:  {
                    'lat': lat,
                    'lon': lon,
                    'distance': distance,
                    'rooms': rooms,
                    'beds': beds,
                    'services': checkbox_selected,
                    'checkbox_count': checkbox_count
                    //'url': xhr.responseURL
                },


                success: function(data) {
                        //console.log(xhr.responseURL);
                        console.log(data.result);
                        $('#card_container').empty();

                        for (var i = 0; i < data.result.length; i++) {

                            var template_html = $('#card_template').html();

                            var template_function = Handlebars.compile(template_html);

                            var variables = {
                                'img_uri': data.result[i].img_uri,
                                'title': data.result[i].title,
                                'flat_details': data.result[i].id
                            }

                            var html = template_function(variables);

                            $('.card-columns').append(html);
                        }
                }
            })

        });

    //});

});


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

// Evento che si verifica quando seleziono una voce dalla lista dell'autocompletamento nella searchbox
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

        // coordinate per la find
        $('#latNumberFind').val(latitudine);
        $('#lonNumberFind').val(longitudine);
        //console.log($('#latNumberFind').val());
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
