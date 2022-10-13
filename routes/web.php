<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

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
Route::post('session', [LoginController::class, 'store'])->name('login');
Route::delete('session', [LoginController::class, 'destroy'])->name('logout');

Route::prefix('admin')->group(function () {
    Route::name('admin.')->group(function () {
        Route::resource('books', BookController::class);
    });
});

