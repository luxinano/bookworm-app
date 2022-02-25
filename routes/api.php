<?php

use App\Http\Controllers\API\AuthenController;
use App\Http\Controllers\API\AuthorController;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\DiscountController;
use App\Http\Controllers\API\ReviewController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('register',[AuthenController::class,'register']);
Route::post('login',[AuthenController::class,'login']);

Route::resource('authors',AuthorController::class);
Route::resource('categories',CategoryController::class);
Route::resource('discounts', DiscountController::class);
Route::resource('reviews', ReviewController::class);
Route::resource('users', UserController::class);
//Route::resource('books', BookController::class);
Route::get('books/onsale',[BookController::class,'onsale']);
//Route::get('books',[BookController::class,'index']);


