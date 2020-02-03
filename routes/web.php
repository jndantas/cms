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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::resource('category', 'CategoryController');
    Route::resource('tag', 'TagController');
    Route::resource('posts', 'PostController');

    Route::get('/users', ['uses' => 'UserController@index','as' => 'users']);

    Route::get('/user/create', [
        'uses' => 'UserController@create',
        'as' => 'user.create'
    ]);

    Route::post('/user/store', [
        'uses' => 'UserController@store',
        'as' => 'user.store'
    ]);

    Route::get('/user/edit/{id}', [
        'uses' => "UserController@edit",
        'as' => 'user.edit'
    ]);

    Route::post('/user/update/{id}', [
        'uses' => "UserController@update",
        'as' => 'user.update'
    ]);

    Route::get('/user/delete/{id}', [
        'uses' => "UserController@destroy",
        'as' => 'user.delete'
    ]);

});
