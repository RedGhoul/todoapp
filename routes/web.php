<?php

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

Route::get('/',[\App\Http\Controllers\HomeController::class, 'index']);

Route::prefix('todo')->group(function(){
    //Create Form
    Route::get('/create', [\App\Http\Controllers\TodoController::class, 'create'])->middleware('auth');

    // Store listing data
    Route::post('/', [\App\Http\Controllers\TodoController::class, 'store'])->middleware('auth');

    Route::get('/{todo}', [\App\Http\Controllers\TodoController::class, 'show']);

    // Show Edit Form
    Route::get('/{todo}/edit', [\App\Http\Controllers\TodoController::class, 'edit'])->middleware('auth');

    // Update listing
    Route::put('/{todo}', [\App\Http\Controllers\TodoController::class, 'update'])->middleware('auth');

    // delete listing
    Route::delete('/{todo}', [\App\Http\Controllers\TodoController::class, 'destroy'])->middleware('auth');

});

Route::get('/register', [\App\Http\Controllers\UserController::class, 'create'])->middleware('guest');

Route::post('/register', [\App\Http\Controllers\UserController::class, 'store'])->middleware('guest');

Route::post('/logout', [\App\Http\Controllers\UserController::class, 'logout'])->middleware('auth');

Route::get('/login', [\App\Http\Controllers\UserController::class, 'login'])->name('login')->middleware('guest');

Route::post('/authenticate', [\App\Http\Controllers\UserController::class, 'authenticate'])->middleware('guest');;
