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
Route::get('/profile/{user}', 'Front\UserProfileController@show')->name('users.profile.show');

Route::get('/profile/{user}/edit', 'Front\UserProfileController@edit')->name('users.profile.edit');
Route::match(['put', 'patch'], '/profile/{user}', 'Front\UserProfileController@update')->name('users.profile.update')->middleware('auth');

Route::get('/section/{section}/posts', 'Front\PostController@index')->name('posts.index');
Route::get('/section/{section}/posts/{post}', 'Front\PostController@show')->name('posts.show');


// admin routes
Route::group([
    'middleware' => ['auth', 'admin'],
    'namespace' => 'Admin',
    'prefix' => 'admin',
    'as' => 'admin.',
], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::get('/sections', 'SectionController@index')->name('sections.index');

    Route::get('/sections/create', 'SectionController@create')->name('sections.create');
    Route::post('/sections', 'SectionController@store')->name('sections.store');

    Route::get('/sections/{id}/edit', 'SectionController@edit')->name('sections.edit');
    Route::match(['put', 'patch'], '/sections/{id}', 'SectionController@update')->name('sections.update');

    Route::get('/sections/{id}', 'SectionController@show')->name('sections.show');
    Route::delete('/sections/{id}', 'SectionController@destroy')->name('sections.destroy');

    Route::resource('/events', 'EventController');
});

