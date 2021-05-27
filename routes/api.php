<?php

use App\Http\Controllers\ExampleAPIController;
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

Route::get('/example', [ExampleAPIController::class, 'index']);
Route::get('/example/getEmail', [ExampleAPIController::class, 'getEmail']);
Route::post('/example', [ExampleAPIController::class, 'store']);
