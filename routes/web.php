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

// Route::get('/','AlbumsController@index');

Route::get('/albums','AlbumsController@index');
Route::get('/albums/create','AlbumsController@create');
Route::get('/albums/{id}','AlbumsController@show');


Route::post('/albums/create','AlbumsController@store');



// Route::resource('albums','AlbumsController');


Route::get('/photos/upload/{album_id}','PhotosController@create');

Route::post('/photos/upload','PhotosController@store');

Route::get('/photos/{photo_id}','PhotosController@show');
Route::delete('/photos/{photo_id}','PhotosController@destroy');




Route::get('/home', 'AlbumsController@index')->name('home');
