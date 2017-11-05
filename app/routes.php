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

Route::get('beer/{id}','HomeController@showBeer');
Route::get('brewer/{id}','HomeController@showBrewer');
Route::get('locality/{id}','HomeController@showLocality');
Route::get('style/{id}','HomeController@showStyle');

Route::group(['prefix'=>'ajax'],function(){
    Route::get('beermap/','AjaxController@beerMap');
    Route::get('beerlocation/{id}','AjaxController@beerLocation');
});


Route::group(['prefix'=>'dashboard','before'=>'auth'],function(){
    Route::get('/','DashboardController@index');

    Route::group(['prefix'=>"beers"],function(){
        Route::get('/','BeerController@index');
        Route::get('/create','BeerController@create');
        Route::get('/edit/{id}','BeerController@edit');
        Route::get('/delete/{id}','BeerController@destroy');
        Route::post('save','BeerController@store');
    });

    Route::group(['prefix'=>"brewers"],function(){
        Route::get('/','BrewerController@index');
        Route::get('/create','BrewerController@create');
        Route::get('/edit/{id}','BrewerController@edit');
        Route::get('/delete/{id}','BrewerController@destroy');
        Route::post('save','BrewerController@store');
    });

    Route::group(['prefix'=>"localities"],function(){
        Route::get('/','DashboardController@localities');
        Route::get('/delete/{id}','DashboardController@deleteLocality');
        Route::post('/save','DashboardController@saveLocality');
    });

    Route::group(['prefix'=>"styles"],function(){
        Route::get('/','DashboardController@styles');
        Route::get('/delete/{id}','DashboardController@deleteStyle');
        Route::post('/save','DashboardController@saveStyle');
    });

    Route::group(['prefix'=>"account"],function(){
        Route::get('/','DashboardController@account');
        Route::get('/export/{format}','DashboardController@export');
    });


    Route::group(['prefix'=>'ajax'],function(){
        Route::get('brewer-autocomplete/{term}','AjaxController@brewerAutocomplete');

        Route::get('locality-autocomplete/{term}','AjaxController@localityAutocomplete');
        Route::get('getlocality/{id}','AjaxController@getLocality');
        Route::get('find-locality','AjaxController@findLocality');
        Route::get('find-flag','AjaxController@findFlag');

        Route::get('style-autocomplete/{term}','AjaxController@styleAutocomplete');
        Route::get('getstyle/{id}','AjaxController@getStyle');

        Route::get('search/{element}','AjaxController@searchElement');
        Route::get('search/{element}/{text}','AjaxController@searchElement');
    });
});
