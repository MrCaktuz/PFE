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

Route::get( '/', 'UserController@index' );
Route::get( 'conseil-administration', 'RoleController@ca' );
Route::get( 'entraineurs', 'RoleController@trainer' );
Route::get( 'equipes', 'TeamController@index' );
Route::get( 'equipes/{equipe}', 'TeamController@show' );
Route::get( 'reglement' );
Route::get( 'calendrier' );
Route::get( 'albums', 'PhotoController@album_index' );
Route::get( 'albums/{album}', 'PhotoController@album_show' );
Route::get( 'telechargements' );
Route::get( 'complexe' );
Route::get( 'coaching' );
Route::get( 'evenements/{evenement}', 'EventController@show' );
Route::get( 'identification' );
Route::get( 'users/', 'UserController@index' );
Route::get( 'users/{user}', 'UserController@show' );
Route::get( 'contact', function () {
	return view( 'contact' );
} );
// Authentication
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

// Import from excel
Route::get('import-export-csv-excel',array('as'=>'excel.import','uses'=>'FileController@importExportExcelORCSV'));
Route::post('import-csv-excel',array('as'=>'import-csv-excel','uses'=>'FileController@importFileIntoDB'));
Route::get('download-excel-file/{type}', array('as'=>'excel-file','uses'=>'FileController@downloadExcelFile'));

// temp
Route::get( 'role/', 'RoleController@index' );
Route::get( 'role/{role}', 'RoleController@show' );
