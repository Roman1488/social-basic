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

Route::post('/createpost', [
    'uses' => 'PostController@postCreatePost',
    'as' => 'post.create'
])->middleware('auth');

Route::get('/delete-post/{post_id}', [
    'uses' => 'PostController@getDeletePost',
    'as' => 'post.delete'
])->middleware('auth');

Route::post('/edit', [
    'uses' => 'PostController@postEditPost',
    'as' => 'edit'
])->middleware('auth');

Route::post('/profile.save', [
    'uses' => 'UserController@postSaveProfile',
    'as' => 'profile.save'
])->middleware('auth');

Route::get('/profile', [
    'uses' => 'UserController@getProfile',
    'as' => 'profile'
])->middleware('auth');

Route::get('/userimage/{filename}', [
    'uses' => 'UserController@getUserImage',
    'as' => 'profile.image'
])->middleware('auth');
