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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('home');
    });

    Route::resource('benevoles', 'BenevoleController');
    Route::resource('beneficiaires', 'BeneficiaireController');
    Route::resource('services', 'ServiceController');

    Route::post('/benevoles/{benevole}/services', 'ServiceController@store');
    Route::post('/beneficiaires/{beneficiaire}/services', 'ServiceController@store');
});

