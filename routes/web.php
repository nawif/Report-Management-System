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

Route::prefix('report')->middleware(['auth', 'CanView'])->group(function () {
    Route::get('/home', 'ReportController@getReportList');
    Route::get('/view/{id}', 'ReportController@getReport')->middleware('CanViewReport');

    Route::post('/create', 'ReportController@createReport')->middleware('CanCreate');
    Route::get('/create', 'ReportController@getCreateReportPage')->middleware('CanCreate');

    Route::get('/edit/{id}', 'ReportController@edit')->middleware(['CanEdit', 'CanViewReport']);
    Route::patch('/edit/{id}', 'ReportController@update');

    Route::delete('/{id}', 'ReportController@delete')->middleware(['CanDelete', 'CanViewReport']);

    // search
    Route::get('/search', 'ReportController@search');
    Route::get('/author/{author_id}', 'ReportController@getAuthorReportList');
    Route::get('/tag/{tag}', 'ReportController@getReportsByTag');
});


Route::prefix('user')->middleware('auth')->group(function () {
    Route::get('/me', 'UserController@editForm');
    Route::patch('/me', 'UserController@edit');
    Route::get('/logout', 'UserController@logout');

    //ADMIN ONLY
    Route::get('/', 'UserController@index')->middleware('checkIfAdmin');
    Route::delete('/{id}', 'UserController@delete')->middleware('checkIfAdmin');
    Route::patch('/{id}/{type}', ['as' => 'editUser', 'uses' => 'UserController@update'])->middleware('checkIfAdmin');

});

Route::prefix('group')->middleware(['auth', 'checkIfAdmin'])->group(function () {
    Route::get('/', 'GroupController@index');
    Route::delete('/{id}', 'GroupController@destroy');
    Route::patch('/{id}', 'GroupController@update');
    Route::post('/create', 'GroupController@store');
    Route::get('/user/{id}', 'GroupController@showUserList');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



