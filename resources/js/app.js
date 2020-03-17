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


// var map = tt.map({
//     key: 'Y2cMr97XoBZZKKVXgUS844gofkPiZFnA',
//     container: 'map',
//     center: [15.547122, 41.463743],
//     zoom: 18,
//     style: 'tomtom://vector/1/basic-main',
//     //dragPan: !isMobileOrTablet()
// });

// map.addControl(new tt.FullscreenControl());
// map.addControl(new tt.NavigationControl());



// Options for the fuzzySearch service
var searchOptions = {
    key: 'Y2cMr97XoBZZKKVXgUS844gofkPiZFnA',
    language: 'it-IT',
    // idxSet: 'Str',
    extendedPostalCodesFor: "None",
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

    // chiamata alla funzione di creazione mappa per pag dettaglio appartamento
    var lonNumber = $('#lonNumber').val();
    var latNumber = $('#latNumber').val();
    console.log(latNumber + lonNumber);

    createMap(lonNumber, latNumber);
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
        // alert('Longitudine:' + longitudine + ' e latitudine: ' + latitudine);
        console.log($('#lat').val());
        console.log($('#lon').val());

        // createMap(longitudine, latitudine);
    }
}

function isFuzzySearchResult(event) {
    return !('matches' in event.data.result);
}



function createMap(longitudine, latitudine) {
    //console.log(longitudine);
    //var v1 = new tt.LngLat(longitudine, latitudine);
    //console.log(v1);
    var map = tt.map({
        key: 'Y2cMr97XoBZZKKVXgUS844gofkPiZFnA',
        container: 'map',
        center:[latitudine, longitudine],
        zoom: 15,
        style: 'tomtom://vector/1/basic-main',
        //dragPan: !isMobileOrTablet()
    });

    map.addControl(new tt.FullscreenControl());
    map.addControl(new tt.NavigationControl());
}
