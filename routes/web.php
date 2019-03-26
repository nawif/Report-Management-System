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
    return view('welcome');
});

Route::prefix('report')->middleware('auth')->group(function () {
    Route::get('/home', 'ReportController@getReportList');
    Route::get('/view/{id}', 'ReportController@getReport');

    Route::post('/create', 'ReportController@createReport');
    Route::get('/create', 'ReportController@getCreateReportPage');

    // search
    Route::get('/search', 'ReportController@search');
    Route::get('/author/{author_id}', 'ReportController@getAuthorReportList');
    Route::get('/tag/{tag}', 'ReportController@getReportsByTag');
});


Route::prefix('user')->middleware('auth')->group(function () {
    Route::get('/', 'UserController@index');
    Route::get('/me', 'UserController@editForm');
    Route::patch('/me', 'UserController@edit');
    Route::delete('/{id}', 'UserController@delete');
    Route::patch('/{id}', 'UserController@update');
});

Route::prefix('group')->middleware('auth')->group(function () {
    Route::get('/', 'GroupController@index');
    Route::delete('/{id}', 'GroupController@destroy');
    Route::patch('/{id}', 'GroupController@update');
    Route::post('/create', 'GroupController@store');
    Route::get('/user/{id}', 'GroupController@showUserList');

});


Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');



