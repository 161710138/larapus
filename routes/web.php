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

Route::get('/', 'GuestController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix'=>'admin', 'middleware'=>['auth']], function () {
//Route::group(['prefix'=>'admin', 'middleware'=>['auth', 'role:admin']], function () {
// Route diisi disini...
	Route::resource('authors', 'AuthorsController');
	Route::resource('books', 'BooksController');
	Route::resource('members', 'MembersController');
});

Route::get('books/{book}/borrow', [
'middleware' => ['auth', 'role:member'],
'as' => 'guest.books.borrow',
'uses' => 'BooksController@borrow'
]);

Route::put('books/{book}/return', [
'middleware' => ['auth', 'role:member'],
'as' => 'member.books.return',
'uses' => 'BooksController@returnBack'
]);
Route::get('settings/profile', 'SettingsController@profile');
Route::get('settings/profile/edit', 'SettingsController@editProfile');
Route::post('settings/profile', 'SettingsController@updateProfile');
Route::get('settings/password', 'SettingsController@editPassword');
Route::post('settings/password', 'SettingsController@updatePassword');


