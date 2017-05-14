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

Route::group(['namespace' => 'Auth'],function(){
    // Authentication Routes...
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout')->name('logout');

    // Password Reset Routes...
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset.token');
    Route::post('password/reset', 'ResetPasswordController@reset');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function(){
        return redirect('/benevoles');
    });

    Route::resource('benevoles', 'BenevoleController');
    Route::put('benevoles', 'BenevoleController@index');

    Route::resource('beneficiaires', 'BeneficiaireController');
    Route::put('beneficiaires', 'BeneficiaireController@index');

    Route::resource('services', 'ServiceController');
    Route::put('services', 'ServiceController@index');

    Route::resource('users', 'UserController');

    Route::post('/benevoles/{benevole}/services', 'ServiceController@store');
    Route::post('/beneficiaires/{beneficiaire}/services', 'ServiceController@store');

    Route::get('/list/benevole.json', 'BenevoleController@listAllForAutocomplete');
    Route::get('/list/beneficiaire.json', 'BeneficiaireController@listAllForAutocomplete');

});

