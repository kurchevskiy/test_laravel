<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', function () {
    return redirect('home');
});

Route::get('/events/search', 'EventsController@search');
Route::resource('events', 'EventsController');
Route::resource('articles', 'ArticlesController');
Route::auth();
Route::get('/home', 'HomeController@index');

