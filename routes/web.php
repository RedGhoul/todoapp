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

    Route::get('/all', [\App\Http\Controllers\TodoController::class, 'index']);

    //Create Form
    Route::get('/create', [\App\Http\Controllers\TodoController::class, 'create']);

    // Store todo data
    Route::post('/store', [\App\Http\Controllers\TodoController::class, 'store']);

    Route::get('/{todo_id}/show', [\App\Http\Controllers\TodoController::class, 'show']);

    // Show Edit Form
    Route::get('/{todo_id}/edit', [\App\Http\Controllers\TodoController::class, 'edit']);

    // Update listing
    Route::put('/{todo_id}/update', [\App\Http\Controllers\TodoController::class, 'update']);

    // delete listing
    Route::delete('/{todo_id}/destroy', [\App\Http\Controllers\TodoController::class, 'destroy']);

})->middleware('auth');

Route::get('/register', [\App\Http\Controllers\UserController::class, 'create'])->middleware('guest');

Route::post('/register', [\App\Http\Controllers\UserController::class, 'store'])->middleware('guest');

Route::post('/logout', [\App\Http\Controllers\UserController::class, 'logout'])->middleware('auth');

Route::get('/login', [\App\Http\Controllers\UserController::class, 'login'])->name('login')->middleware('guest');

Route::post('/authenticate', [\App\Http\Controllers\UserController::class, 'authenticate'])->middleware('guest');;
