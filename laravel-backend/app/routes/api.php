<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;


Route::apiResource('categories', CategoryController::class);
Route::apiResource('authors', AuthorController::class);
Route::apiResource('books', BookController::class);


Route::post('books/{book}/authors/{author}', [BookController::class, 'attachAuthor']);
Route::post('books/{book}/categories/{category}', [BookController::class, 'attachCategory']);

Route::post('categories/{category}/books/{book}', [CategoryController::class, 'attachBook']);
Route::post('authors/{author}/books/{book}', [AuthorController::class, 'attachBook']);


Route::delete('books/{book}/authors/{author}', [BookController::class, 'detachAuthor']);
Route::delete('books/{book}/categories/{category}', [BookController::class, 'detachCategory']);

Route::delete('categories/{category}/books/{book}', [CategoryController::class, 'detachBook']);
Route::delete('authors/{author}/books/{book}', [AuthorController::class, 'detachBook']);