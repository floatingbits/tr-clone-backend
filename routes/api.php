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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::resource('/v1/boards', v1\BoardController::class, ['except' => ['create', 'edit']]);
Route::resource('/v1/boards.lists', v1\BoardListController::class, ['only' => ['index']]);
Route::resource('/v1/lists', v1\CardListController::class, ['except' => ['create', 'edit', 'index']]);