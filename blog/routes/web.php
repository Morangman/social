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
Route::get('/posts', 'PostController@index');

Route::post('/add_post', 'PostController@add_post');
Route::delete('/post_delete/{post_id}', 'PostController@destroy');

Route::post('/like', [ 'uses' => 'PostController@postLikePost', 'as' => 'like']);
Route::post('/dislike', [ 'uses' => 'PostController@postDislikePost', 'as' => 'dislike']);

Route::post('/get', 'RequestController@index');
Route::get('/getdata', 'RequestController@getdata');

Route::get('/home', function () {
    return view('home');
   });

Route::get('/settings', function () {
    return view('settings');
});
