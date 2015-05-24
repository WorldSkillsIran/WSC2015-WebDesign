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


Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function () {
    Route::get('/{type?}', 'RouteController@getIndex', [
        'before' => 'Authenticate'
    ]);
    Route::get('/book/{route}', 'RouteController@getBook');
    Route::get('/route/new', 'RouteController@getCreate');
    Route::post('/route/new', 'RouteController@postCreate');
    Route::post('/route/{route}/rate', 'RouteController@postRate');
    Route::model('route', 'App\Route');
});