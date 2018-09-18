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

Route::get('/', 'VideoController@index');

/* Route::group(['middleware' => ['auth'] ], function () {

}); */

Route::get('/upload', 'VideoController@showUploadPage');

Route::post('/upload', 'VideoController@store');

Route::get('/videos/{video}', 'VideoController@singleVideo');

Route::post('/videos/{video}/comments', 'CommentController@store');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
