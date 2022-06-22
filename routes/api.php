<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CategoryController;

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
Route::prefix('book')->group(function(){
    Route::controller(ReviewController::class)->group(function(){
        Route::get('{book_id}/rating','rating');
        Route::get('{book_id}/review','review');
    });
    Route::controller(BookController::class)->group(function(){
        Route::get('discount','discount');
        Route::get('recommended','recommended');
        Route::get('{id?}','index');
    });
});
Route::resource('category/',CategoryController::class);
