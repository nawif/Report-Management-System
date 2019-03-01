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


Route::group(['middleware' => canView::class],function(){
    Route::get('/home1','GroupController@createGroup');
});

Route::prefix('report')->group(function () {
    Route::get('/home', 'ReportController@getReportList');
    Route::get('/view/{id}', 'ReportController@getReport');

    Route::post('/create', 'ReportController@createReport');
    Route::get('/create', 'ReportController@getCreateReportPage');

    // search
    Route::get('/search', 'ReportController@search');
    Route::get('/author/{author_id}', 'ReportController@getAuthorReportList');
    Route::get('/tag/{tag}', 'ReportController@getReportsByTag');



});

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/group', 'GroupController@createGroup');



