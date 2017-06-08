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

// Authenation routes.
Auth::routes();
Route::get('auth/{provider}', 'Auth\SocialAuthencation@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\SocialAuthencation@handleProviderCallback');

Route::get('/', 'HomeController@index')->name('home');

// Petition routes.
Route::get('/petitions', 'PetitionController@index')->name('petitions.index');
Route::get('/petitions/show/{id}', 'PetitionController@show')->name('petitions.show');
Route::get('/petitions/create', 'PetitionController@create')->name('petitions.create');
Route::post('/petitions/store', 'PetitionController@store')->name('petitions.store');

// Profile routes.
Route::get('/profile/member/{id}', 'ProfileController@members')->name('profile.member');

// Organization routes
Route::get('/organizations/create', 'OrganizationController@create')->name('organization.create');
Route::post('/organizatons/store', 'OrganizationController@store')->name('organization.store');
