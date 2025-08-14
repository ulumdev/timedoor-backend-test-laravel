<?php

use Illuminate\Support\Facades\Route;
use App\Models\Book;

Route::get('/books/by-author/{authorId}', function ($authorId) {
    return Book::where('author_id', $authorId)->select('id', 'title')->get();
});
