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

Route::group(['namespace' => 'Auth'], function () {
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
    Route::get('/', 'BenevoleController@home');

    Route::put('benevoles', 'BenevoleController@index');
    Route::post('benevoles/{benevole}/restore', 'BenevoleController@restore');
    Route::post('benevoles/{benevole}/indisponibilites', 'BenevoleController@addIndisponibilite');
    Route::delete('benevoles/{benevole}/indisponibilites/{indisponibilite}', 'BenevoleController@deleteIndisponibilite');
    Route::resource('benevoles', 'BenevoleController');

    Route::put('beneficiaires', 'BeneficiaireController@index');
    Route::post('beneficiaires/{beneficiaire}/restore', 'BeneficiaireController@restore');
    Route::resource('beneficiaires', 'BeneficiaireController');

    Route::put('services', 'ServiceController@index');
    Route::put('services/organismes', 'ServiceController@indexOrganismes');
    Route::get('services/organismes', 'ServiceController@indexOrganismes');
    Route::resource('services', 'ServiceController');

    Route::put('users', 'UserController@index');
    Route::post('users/{user}/restore', 'UserController@restore');
    Route::resource('users', 'UserController');

    Route::put('organismes', 'OrganismeController@index');
    Route::post('organismes/{organisme}/restore', 'OrganismeController@restore');
    Route::resource('organismes', 'OrganismeController');

    Route::delete('tournees/{tournee}/remove/{beneficiaire}', 'TourneeController@remove');
    Route::post('tournees/{tournee}/add', 'TourneeController@add');
    Route::put('tournees/{tournee}', 'TourneeController@update');
    Route::get('tournees/{tournee}/moveUp/{beneficiaire}', 'TourneeController@moveUp');
    Route::get('tournees/{tournee}/moveDown/{beneficiaire}', 'TourneeController@moveDown');
    Route::get('tournees/{tournee}/printAlpha', 'TourneeController@printAlpha');
    Route::get('tournees/{tournee}/print', 'TourneeController@print');
    Route::get('tournees/{tournee}/printConducteur', 'TourneeController@printConducteur');
    Route::resource('tournees', 'TourneeController');

    Route::resource('notes', 'NoteController');

    Route::get('/list/benevole.json', 'BenevoleController@listAllForAutocomplete');
    Route::get('/list/beneficiaire.json', 'BeneficiaireController@listAllForAutocomplete');
    Route::get('/list/organisme.json', 'OrganismeController@listAllForAutocomplete');
});

