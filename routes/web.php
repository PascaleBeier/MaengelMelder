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
Route::get('/', 'FrontController@index');
Route::post('/', 'FrontController@store');

// Login, Logout, Forgot Password
Auth::routes();

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
    Route::get('/categories/{category}/users', 'CategoryUserController@index')
        ->name('categories.users.index');
    Route::get('/categories/{category}/users/create', 'CategoryUserController@create')
        ->name('categories.users.create');
    Route::post('/categories/{category}/users', 'CategoryUserController@store')
        ->name('categories.users.store');
});

