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

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('welcome');
    });

});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
    Route::get('/group/{id}', 'GroupController@show');
    Route::post('/newgroup', 'GroupController@newgroup');
    Route::post('group/{id}/groupadduser', 'GroupController@adduser');
	Route::post('group/{id}/groupaddfile', 'GroupController@addfile');
	Route::get('group/{id}/downloadfile/{fileName}', 'GroupController@downloadfile');
	Route::get('group/{id}/deletefile/{fileName}', 'GroupController@deletefile');



});