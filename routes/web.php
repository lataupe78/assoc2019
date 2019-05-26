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

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

// front Sections routes
Route::get('/section/{section}', 'Front\SectionController@show')->name('sections.show');

// front User routes
Route::get('/profile/{username}', 'Front\UserProfileController@show')->name('users.profile.show');
Route::get('/profile/{username}/edit', 'Front\UserProfileController@edit')->name('users.profile.edit');
Route::match(['put', 'patch'], '/profile/{username}', 'Front\UserProfileController@update')->name('users.profile.update')->middleware('auth');



Route::group([
    'middleware' => ['auth', 'admin'],
    'namespace' => 'Admin',
    'prefix' => 'admin',
    'as' => 'admin.',
], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::get('/sections', 'SectionController@index')->name('sections.index');
    Route::put('/sections/{id}', 'SectionController@update')->name('sections.update');
});
