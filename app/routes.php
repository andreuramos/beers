<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::get('login','HomeController@login');
Route::post('dologin','HomeController@dologin');
Route::get('logout','HomeController@logout');


Route::group(['prefix'=>'dashboard'],function(){
    Route::get('/','DashboardController@index');
    Route::get('/styles','DashboardController@styles');
});
