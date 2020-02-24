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


Route::get('/books/{bookId}',  					function(Request $request){ return \App\Book::find(Array("id"=>$request->bookId))->first(); } );
Route::get('/leaves/{leafId}',  				function(Request $request){ return \App\Leaf::find(Array("id"=>$request->leafId))->first()->with("style"); } );
Route::get('/books/{bookId}/leaves/',  			function(Request $request){ return \App\Book::find($request->bookId)->newLeaf(); } );
Route::POST('/books/{bookId}/leaves/',  		function(Request $request){ return \App\Book::find(Array("id"=>$request->bookId))->first()->createLeaf(); } );
Route::POST('/books/{bookId}/leaves/{leafId}',  "leafController@update"  );

