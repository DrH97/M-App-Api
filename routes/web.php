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
    return redirect('/home');
});

// Route::namespace('Auth')->middleware('auth')-> group(function() {
//     Route::get('/', function() {
//         return view('welcome');
//     }) ;

//     Route::post('/login', 'LoginController@login');
//     Route::post('/logout', 'LoginController@logout');

//     Route::post('/register', 'RegisterController@register');
// });
// Auth::routes();

// Route::middleware('auth')->get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    
        // Route::prefix('places')->group(function() {
        //     Route::get('/', 'PlacesController@index');
        //     Route::get('/{id}', 'PlacesController@show');
        //     Route::get('/{id}/activities', 'PlacesController@indexPlaceActivities');
        //     Route::get('/{place_id}/activities/{id}', 'PlacesController@showPlaceActivity');
        // });
    
        Route::prefix('activities')->group(function() {
            Route::get('/', 'ActivityController@index');
            Route::get('/{id}', 'ActivityController@show');
            Route::get('/{id}/places', 'ActivityController@indexActivityPlaces');
            Route::get('/{activity_id}/places/{id}', 'ActivityController@showActivityPlace');
        });
    
        // Route::prefix('locations')->group(function() {
        //     Route::get('/', 'LocationController@index');
        //     Route::get('/{id}', 'LocationController@show');
        //     Route::get('/{id}/places', 'LocationController@indexLocationPlaces');
        //     Route::get('/{location_id}/places/{id}', 'LocationController@showLocationPlace');
        // });

    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('projects', 'Admin\ProjectsController');
    Route::post('projects_mass_destroy', ['uses' => 'Admin\ProjectsController@massDestroy', 'as' => 'projects.mass_destroy']);
    Route::post('projects_restore/{id}', ['uses' => 'Admin\ProjectsController@restore', 'as' => 'projects.restore']);
    Route::delete('projects_perma_del/{id}', ['uses' => 'Admin\ProjectsController@perma_del', 'as' => 'projects.perma_del']);

    Route::resource('places', 'Admin\PlacesController');
    Route::post('places_restore/{id}', ['uses' => 'Admin\PlacesController@restore', 'as' => 'places.restore']);
    Route::delete('places_perma_del/{id}', ['uses' => 'Admin\PlacesController@perma_del', 'as' => 'places.perma_del']);
    Route::resource('activities', 'Admin\ActivitiesController');

});
