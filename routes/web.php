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
Route::get('/disclaimer', 'DisclaimerController@index')->name('disclaimer');

// Petition routes.
Route::get('/petitions', 'PetitionController@index')->name('petitions.index');
Route::get('/petitions/show/{id}', 'PetitionController@show')->name('petitions.show');
Route::get('/petitions/create', 'PetitionController@create')->name('petitions.create');
Route::post('/petitions/store', 'PetitionController@store')->name('petitions.store');
Route::get('/petitions/delete/{id}', 'PetitionController@destroy')->name('petitions.delete');

// Profile routes.
Route::get('/settings', 'ProfileController@userSettings')->name('profile.settings');
Route::get('/profile/member/{id}', 'ProfileController@members')->name('profile.member');
Route::get('/profile/organization/{id}', 'ProfileController@organization')->name('profile.organization');

// Sgnature routes 
Route::get('/signatures/show/{id}', 'SignatureController@show')->name('signatures.show');

// User management
Route::get('/users', 'UsersController@index')->name('users.index');

// Settings routes
Route::post('/settings/security', 'AccountController@updatePassword')->name('settings.security');

// Comment routes
Route::post('comment/question', 'QuestionsController@comment')->name('comments.question');

// Organization routes
Route::get('/organizations/create', 'OrganizationController@create')->name('organization.create');
Route::post('/organizatons/store', 'OrganizationController@store')->name('organization.store');

// Helpdesk routes.
Route::get('/helpdesk', 'SupportController@index')->name('helpdesk.index');

// Question routes
Route::get('/questions', 'QuestionsController@index')->name('questions.index');
Route::get('/questions/create', 'QuestionsController@create')->name('questions.create');
Route::post('/questions.store', 'QuestionsController@store')->name('questions.store');
Route::get('/question/show/{id}', 'QuestionsController@show')->name('questions.show');
Route::get('/questions/user', 'QuestionsController@user')->name('questions.user');
Route::get('/questions/json/{id}', 'QuestionsController@getById')->name('questions.json');
