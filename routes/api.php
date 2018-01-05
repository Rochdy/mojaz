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

Route::post('/login', 'UserController@login');
Route::post('/register', 'UserController@register');

Route::get('/list','ListsController@showAll');
Route::get('/list/{list}','ListsController@showAll');
Route::post('/list/create','ListsController@showAll');
Route::put('/list/{list}/edit','ListsController@showAll');
Route::delete('/list/{list}/delete','ListsController@showAll');

Route::post('/list/{list}/item','ListsController@showAll');
Route::put('/list/{list}/item/{item}/edit','ListsController@showAll');
Route::delete('/list/{list}/item/{item}/edit','ListsController@showAll');
