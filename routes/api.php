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


Route::prefix('user')->group(function () {
    Route::post('/create', 'MigrationController@createUser');
});
Route::prefix('report')->group(function () {
    Route::post('/create', 'MigrationController@createReport');
    Route::post('/create/{id}', 'MigrationController@attachFilesToReport');

});
Route::prefix('group')->group(function () {
    Route::post('/create', 'MigrationController@createGroup');
});
