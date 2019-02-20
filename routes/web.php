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

Auth::routes();

Route::prefix('report')->group(function () {
    Route::get('/{id}', 'ReportController@getReport');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/group', 'GroupController@createGroup');



