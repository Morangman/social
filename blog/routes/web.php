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

Route::post('/get_posts', 'PostController@get_posts');
Route::post('/get_post_refresh_info', 'PostController@get_post');
Route::post('/hide_post', 'PostController@hide_post');
Route::post('/get_friend_posts', 'FriendController@get_friend_posts');

Route::post('/m/logout', 'LoginController@logout');

Route::post('/add_post', 'PostController@add_post');
Route::delete('/post_delete/{post_id}', 'PostController@destroy');

Route::post('/update_image', 'UserController@update_image');


Route::post('/like', 'PostController@postLikePost');

Route::get('/get_users', 'UserController@get_users');
Route::post('/get_user', 'UserController@get_user');
Route::post('/update_profile_info', 'UserController@update_profile_info');
Route::get('/get_user_info', 'UserController@get_user_info');
Route::delete('/delete_image', 'UserController@delete_image');

Route::get('/getdata', 'RequestController@getdata');

Route::post('/add_friend', 'FriendController@add_friend');
Route::delete('/delete_friend/{friend_id}', 'FriendController@delete_friend');
Route::post('/check_friend', 'FriendController@check_friend');
Route::post('/friend_friends', 'FriendController@friend_friends');
Route::get('/get_all_friends', 'FriendController@get_all_friends');

Route::post('/create_room', 'ChatController@createRoom');
Route::post('/get_messages', 'ChatController@getMessages');
Route::post('/send', 'ChatController@sendMessage');
Route::get('/get_rooms', 'ChatController@getRooms');
Route::post('/search', 'ChatController@searchRooms');

Route::post('/send_comment', 'CommentController@sendComment');
Route::post('/get_post_info', 'CommentController@getPostComments');


Route::get('/home', function () {
    return view('home');
})->middleware('auth');

Route::get('/settings', function () {
    return view('settings');
})->middleware('auth');

Route::get('/chat', function () {
    return view('chat');
})->middleware('auth');

Route::get('/profile/{user_id}', function () {
    return view('profile');
})->middleware('auth');

Route::get('/redirect', 'SocialAuthFacebookController@redirect');
Route::get('/callback', 'SocialAuthFacebookController@callback');
