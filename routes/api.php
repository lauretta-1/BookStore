<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\BooksController;

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

Route::middleware('api')->prefix('v1')->group(function(){
    Route::post('login', [AuthController::class, 'login'])->name('user.login');
    Route::post('register', [AuthController::class, 'register'])->name('user.register');
    Route::post('logout', [AuthController::class, 'logout'])->name('user.logout');

    Route::apiResource('users', UsersController::class);
    
    Route::apiResource('books', BooksController::class);

});



