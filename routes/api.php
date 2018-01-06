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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
//
// Route::fallback('UserController@login');

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/test', function (Request $request) {
         return response()->json(['name' => 'test']);
    });
});


Route::post('/login', 'UserController@login');
Route::post('/register', 'UserController@register');

Route::post('/list','ListsController@showAll');
Route::post('/list/create','ListsController@create');
Route::post('/list/{list}','ListsController@showItems');
Route::put('/list/{list}/edit','ListsController@edit');
Route::delete('/list/{list}/delete','ListsController@delete');

Route::post('/list/{list}/item','ItemsController@create');
Route::put('/list/{list}/item/{item}/edit','ItemsController@edit');
Route::delete('/list/{list}/item/{item}/delete','ItemsController@delete');
