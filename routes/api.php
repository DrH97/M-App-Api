<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->post('/v1/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api\Auth')->middleware('web')->prefix('/v1/user')-> group(function() {
    Route::post('/login', 'LoginController@login');
    Route::post('/logout', 'LoginController@logout');

    Route::post('/register', 'RegisterController@register');
});

Route::namespace('Api\V1')->prefix('v1')->group(function() {

    Route::prefix('places')->group(function() {
        Route::get('/', 'PlaceController@index');
        Route::get('/{id}', 'PlaceController@show');
        Route::get('/{id}/activities', 'PlaceController@indexPlaceActivities');
        Route::get('/{place_id}/activities/{id}', 'PlaceController@showPlaceActivity');
    });

    Route::prefix('activities')->group(function() {
        Route::get('/', 'ActivityController@index');
        Route::get('/{id}', 'ActivityController@show');
        Route::get('/{id}/places', 'ActivityController@indexActivityPlaces');
        Route::get('/{activity_id}/places/{id}', 'ActivityController@showActivityPlace');
    });

    Route::prefix('locations')->group(function() {
        Route::get('/', 'LocationController@index');
        Route::get('/{id}', 'LocationController@show');
        Route::get('/{id}/places', 'LocationController@indexLocationPlaces');
        Route::get('/{location_id}/places/{id}', 'LocationController@showLocationPlace');
    });
    
});
