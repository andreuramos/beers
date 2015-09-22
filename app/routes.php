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


Route::group(['prefix'=>'dashboard','before'=>'auth'],function(){
    Route::get('/','DashboardController@index');
    Route::get('/brewers','DashboardController@brewers');
    Route::get('/styles','DashboardController@styles');
    Route::post('/styles/save','DashboardController@saveStyle');

    Route::group(['prefix'=>'ajax'],function(){
        Route::get('style-autocomplete/{term}','AjaxController@styleAutocomplete');
    });
});
