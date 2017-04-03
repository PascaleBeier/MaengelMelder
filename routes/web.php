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

// Public Routes
// @todo: Move to Controller
Route::get('/', function () {
    $categories = \App\Category::active();
    // @todo: Use Guzzle for this
    $response = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.config('app.client').',Germany&key='.config('googlemaps.apiKey'));
    $json = json_decode($response);
    $bounds = $json->results[0]->geometry->bounds;

    return view('frontend.index', compact('categories', 'bounds'));
});
Route::post('/', 'ReportController@store');

// Authentication Routes
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@authenticate');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

// Private Routes
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', function () {
        return redirect()->route('reports.index');
    });

    // Parent Model Routes
    Route::resource('/reports', 'ReportController');
    Route::resource('/users', 'UserController');
    Route::resource('/categories', 'CategoryController');

    // Pivot Model Routes

    // Category => Users
    Route::get('/categories/{category}/users', 'CategoryUserController@index')->name('categories.users.index');
    Route::get('/categories/{category}/users/create', 'CategoryUserController@create')->name('categories.users.create');
    Route::post('/categories/{category}/users', 'CategoryUserController@store')->name('categories.users.store');

    // User => Categories
    Route::get('/users/{user}/categories', 'UserCategoryController@index')->name('users.categories.index');
    Route::get('/users/{user}/categories/create', 'UserCategoryController@create')->name('users.categories.create');
    Route::post('/users/{user}/categories', 'UserCategoryController@store')->name('users.categories.store');
});
