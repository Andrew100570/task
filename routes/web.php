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


Route::get('/test', 'InformationController@test')->name('test');
Route::post('/test1', 'InformationController@posTtestPost')->name('postPost');
Route::get('/apiTest', 'InformationController@apiTest')->name('apiTest');
Route::get('/result', 'InformationController@result')->name('result');
Route::get('/view', 'InformationController@view')->name('view');

