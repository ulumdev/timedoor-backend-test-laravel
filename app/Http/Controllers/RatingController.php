<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    //
    public function create()
    {
        $authors = Author::all();
        return view('pages.ratings.create', [
            'authors' => $authors,
            'title' => 'Insert Rating',
            'titleContent' => 'Rating',
            'li_1' => 'Rating',
            'subTitleContent' => 'Insert',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|integer|min:1|max:10',
        ]);

        Rating::create([
            'book_id' => $request->book_id,
            'rating' => $request->rating,
        ]);

        return redirect()->route('books.index')->with('success', 'Rating berhasil ditambahkan.');
    }
}
