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

Route::get('/home', 				'HomeController@index')->name('home');

Route::get('/books/', 				'BookController@index')->name('home');
Route::get('/books/{bookId}', 		'BookController@show')->name('home');
Route::POST("/books/", 				"BookController@create");
Route::GET("/books/{bookId}/edit",  "BookController@edit");
Route::POST("/books/{bookId}",		"BookController@update");
Route::DELETE("/books/{bookId}",	"BookController@destroy");

Route::POST("/books/{bookId}/new", 	"LeafController@store")->middleware("auth");
Route::PUT("/leaves/{leafId}", 		"LeafController@edit");
