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
Route::get( '/', 'PageController@home' );
Route::get( '/conseil-administration', 'UserController@comity' );
Route::get( '/entraineurs', 'UserController@trainer' );
Route::get( '/equipes', 'TeamController@index' );
Route::get( '/regles', 'PageController@rules' );
Route::get( '/albums', 'AlbumController@index' );
Route::get( '/albums/{album}', 'AlbumController@show' );
// Route::get( 'user/{user}', 'UserController@show' )->name('profil');
// Route::get( '/contact', 'PageController@contact' )->name('contact');
// Route::get( 'role/', 'RoleController@index' );
// Route::get( 'role/{role}', 'RoleController@show' );

// ******** Auth ********
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
