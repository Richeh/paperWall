<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/books/{bookId}',  function(Request $request){ return \App\Book::find(Array("id"=>$request->bookId))->first()->with("leafs"); } );
Route::get('/leafs/{leafId}',  function(Request $request){ return \App\Leaf::find(Array("id"=>$request->leafId))->first()->with("style"); } );

