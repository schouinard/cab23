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
        return view('welcome');
    });
    Route::get('/benevoles', 'BenevoleController@index');
    Route::get('/benevoles/{benevole}', 'BenevoleController@show');
    Route::post('/benevoles/{benevole}/services', 'ServiceController@store');
    Route::post('/benevoles', 'BenevoleController@store');
    Route::get('/beneficiaires', 'BeneficiaireController@index');
    Route::get('/beneficiaires/{beneficiaire}', 'BeneficiaireController@show');
    Route::post('/beneficiaires/{beneficiaire}/services', 'ServiceController@store');
    Route::post('/beneficiaires', 'BeneficiaireController@store');
});

