<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('pages.books.index');
// });

Route::get('/', [BookController::class, 'index'])->name('books.index');
Route::get('/authors/top', [AuthorController::class, 'topAuthors'])->name('authors.top');
Route::get('/rating/create', [RatingController::class, 'create'])->name('ratings.create');
Route::post('/rating', [RatingController::class, 'store'])->name('ratings.store');
