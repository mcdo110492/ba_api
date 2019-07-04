<?php


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {

    Route::post('login', 'AuthenticationController@login');

    Route::post('logout', 'AuthenticationController@logout');

    Route::post('refresh', 'AuthenticationController@refresh');

    Route::post('me', 'AuthenticationController@me');

});

Route::get('projects', 'ProjectsController@index');

Route::post('projects', 'ProjectsController@store');

Route::put('projects/{id}', 'ProjectsController@update');


Route::get('attributes', 'AttributesController@index');

Route::post('attributes', 'AttributesController@store');

Route::put('attributes/{id}', 'AttributesController@update');


Route::get('attribute/set', 'AttributeSetController@index');

Route::post('attribute/set', 'AttributeSetController@store');

Route::put('attribute/set/{id}', 'AttributeSetController@update');