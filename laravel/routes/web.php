<?php

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

// ******** Front end routes ********
Route::get( '/', 'PageController@home' )->name('home');
Route::get( '/albums', 'AlbumController@index' );
Route::get( '/albums/{album}', 'AlbumController@show' );
Route::get( '/calendrier', 'PageController@calendar' );
Route::get( '/complexe', 'PageController@complexe' );
Route::get( '/coaching', 'CoachingController@index' )->name('coaching');
Route::post( '/coaching', 'CoachingController@store' );
Route::get( '/coaching/{coaching}', 'CoachingController@show' );
Route::get( '/coaching/{coaching}/confirm', 'CoachingController@confirm' );
Route::delete( '/coaching/{coaching}/destroy', 'CoachingController@destroy' );
Route::get( '/conseil-administration', 'UserController@comity' );
Route::get( '/contact', 'PageController@contact' )->name('contact');
Route::post( '/contact', 'PageController@contactForm' );
Route::get( '/entraineurs', 'UserController@trainer' );
Route::get( '/equipes', 'TeamController@index' );
Route::get( '/equipes/{team}', 'TeamController@show' );
Route::get( '/evenements/{event}', 'EventController@show' );
Route::get( '/regles', 'PageController@rules' );
Route::get( '/telechargements', 'DownloadController@index' )->name('telechargements');
Route::get( '/telechargements/{download}', 'DownloadController@show' );
Route::get( '/user/{user}', 'UserController@show' )->name('profil');

// ******** Auth ********
Auth::routes();
Route::get('/home', 'PageController@home')->name('home');
