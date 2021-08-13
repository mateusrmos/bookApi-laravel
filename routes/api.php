<?php

use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\BookController;
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

Route::get('/book/list', [BookController::class, 'list']);
Route::get('/book/{book}', [BookController::class, 'findSingle']);
Route::post('/book', [BookController::class, 'createBook']);
Route::patch('/book/{book}', [BookController::class, 'updateBook']);
Route::delete('/book/{book}', [BookController::class, 'deleteBook']);

Route::get('/author/list', [AuthorController::class, 'list']);
Route::get('/author/{author}', [AuthorController::class, 'findSingle']);
Route::post('/author', [AuthorController::class, 'createAuthor']);
Route::patch('/author/{author}', [AuthorController::class, 'updateAuthor']);
Route::delete('/author/{author}', [AuthorController::class, 'deleteAuthor']);
