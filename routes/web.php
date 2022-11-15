<?php

use Illuminate\Support\Facades\Route;

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


Auth::routes();
Route::middleware('auth')->group(function () {
    Route::get('/', "PostController@index");
    Route::get('/home', "PostController@index");
    Route::resource('posts', 'PostController');
    Route::resource('likes', 'LikeController')->only("store");
    Route::resource('comments', 'CommentController');
    Route::get('user_posts', 'PostController@posts')->name('user_posts');
});
