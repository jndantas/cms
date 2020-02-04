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

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('dashboard', 'AdminController@index')->name('dashboard');
    Route::resource('category', 'CategoryController');
    Route::resource('tag', 'TagController');
    Route::resource('post', 'PostController');
    Route::get('trashed-posts', 'PostController@trashed')->name('post.trashed');
    Route::put('restore-posts/{post}', 'PostController@restore')->name('post.restore');
    Route::resource('user', 'UserController');
    Route::get('changeStatus', 'UserController@changeStatus');
    Route::get('profile', ['uses' => 'ProfileController@index', 'as'=>'user.profile']);
    Route::post('profile/update', ['uses' => 'ProfileController@update', 'as'=>'user.profile.update']);
    Route::get('user/admin/{id}', ['uses' => 'UserController@makeAdmin', 'as' => 'user.admin']);
    Route::get('user/not-admin/{id}', ['uses' => 'UserController@not_admin', 'as' => 'user.not.admin']);
    Route::get('/settings', ['uses' => 'SettingController@index', 'as' => 'settings']);
    Route::post('/settings/update', ['uses' => 'SettingController@update', 'as' => 'settings.update']);
});
