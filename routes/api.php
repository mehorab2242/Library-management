<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//Author Routing
Route::post('author', [AuthorController::class, 'store']);
Route::get('authors', [AuthorController::class, 'index']);
Route::get('author/{id}', [AuthorController::class, 'show']);
Route::delete('author/{id}', [AuthorController::class, 'destroy']);
Route::put('author/{id}', [AuthorController::class, 'update']);

//Book Routing
Route::get('books', [BookController::class, 'index']);
Route::get('author/{id}/books', [BookController::class, 'show']);
Route::delete('book/{id}', [BookController::class, 'destroy']);
Route::put('book/{id}', [BookController::class, 'update']);
Route::post('book', [BookController::class, 'store']);
