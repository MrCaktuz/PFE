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

// ******** Administration routes ********
Route::get( '/admin', 'AdminController@index' );
Route::get( '/admin/family', 'FamilyController@index' );
Route::get( '/admin/family/{family_slug}', 'FamilyController@show' );

// ******** Front end routes ********
Route::get( '/', 'PageController@home' );
// ******** Authentication ********
Auth::routes();
Route::get('/connected', 'PageController@connected')->name('connected');
Route::get('/reseted', 'PageController@reseted')->name('reseted');
Route::get('/mailsent', 'PageController@mailsent')->name('mailsent');

// Route::get( 'conseil-administration', 'RoleController@ca' );
// Route::get( 'entraineurs', 'RoleController@trainer' );
// Route::get( 'equipes', 'TeamController@index' );
// Route::get( 'equipes/{equipe}', 'TeamController@show' );
// Route::get( 'reglement' );
// Route::get( 'calendar', 'GameController@index' );
// Route::get( 'albums', 'PhotoController@album_index' );
// Route::get( 'albums/{album}', 'PhotoController@album_show' );
// Route::get( 'telechargements' );
// Route::get( 'complexe' );
// Route::get( 'coaching' );
// Route::get( 'evenements/{evenement}', 'EventController@show' );
// Route::get( 'identification' );
Route::get( 'user/{user}', 'UserController@show' )->name('profil');
Route::get( '/contact', 'PageController@contact' )->name('contact');

// ******** Import from excel ********
Route::get('import-export-csv-excel',array('as'=>'excel.import','uses'=>'FileController@importExportExcelORCSV'));
Route::post('import-csv-excel',array('as'=>'import-csv-excel','uses'=>'FileController@importFileIntoDB'));
Route::get('download-excel-file/{type}', array('as'=>'excel-file','uses'=>'FileController@downloadExcelFile'));

// ******** Temp ********
Route::get( 'role/', 'RoleController@index' );
Route::get( 'role/{role}', 'RoleController@show' );
