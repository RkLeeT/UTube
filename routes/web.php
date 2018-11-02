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

Route::get('login/google', 'Auth\LoginController@redirectToProvider');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback');

Auth::routes();
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'PagesController@home');
Route::post('/home', 'PagesController@homeAjax');

Route::get('/profile', 'PagesController@profile')->name('profile')->middleware('auth');

Route::get('/view/{id}', 'PagesController@view');

Route::get('/video/{id}/delete', 'PagesController@delete');

Route::get('/view/{id}/delete', 'PagesController@deleteview');
Route::post('/view/{id}/reportvideo', 'PagesController@reportvideo');


Route::post('/view/{id}/reportcomment', 'CommentsController@reportcomment');



Route::post('','PagesController@store')->name('video.store');

Route::post('/save','CommentsController@store');
Route::post('/view/{video_id}/load','CommentsController@load');
Route::post('/editupdate','CommentsController@editupdate');
Route::post('/delete','CommentsController@delete');


Route::resource('comments', 'CommentsController');

// Route::get('/home', 'HomeController@index')->name('home');


Route::post('/view/{video_id}/likes', 'PagesController@favsystem');
Route::post('/view/{video_id}/unlikes', 'PagesController@unfavsystem');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
