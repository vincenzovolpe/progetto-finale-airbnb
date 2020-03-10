<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');

// Genera tutte le rotte per la gestione dell'autenticazione
Auth::routes();



// Specifichiamo un gruppo di route che condividono una serie di comandi,  come per esempio il fatto che possono essere visualizzati solo sesi è loggati
Route::middleware('auth')->prefix('upr')->namespace('Upr')->name('upr.')->group(function() {
    Route::get('/', 'HomeController@index')->name('home');
});
