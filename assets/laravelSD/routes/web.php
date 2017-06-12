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

Route::get('/', function () {
    return view('welcome');
});


Route::resource('user', 'UserController');
Route::resource('role', 'RoleController');
Route::resource('role_user', 'Role_UserController');
Route::resource('photo', 'PhotoController');
Route::resource('team', 'TeamController');
Route::resource('team_user', 'Team_UserController');
Route::resource('photo_team', 'Photo_TeamController');
Route::resource('game', 'GameController');
Route::resource('event', 'EventController');
Route::resource('family', 'FamilyController');
Route::resource('coaching', 'coachingController');
Route::resource('download', 'DownloadController');
Route::resource('setting', 'SettingController');
Route::resource('home', 'HomeController');
Route::resource('complexe', 'ComplexeController');
Route::resource('contact', 'ContactController');
Route::resource('trainer', 'TrainerController');
Route::resource('comity', 'ComityController');
Route::resource('rule', 'RuleController');
Route::resource('downloadpage', 'DownloadPageController');
Route::resource('coachingpage', 'CoachingPageController');
Route::resource('sponsor', 'SponsorController');
