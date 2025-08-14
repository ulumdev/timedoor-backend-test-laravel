<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
    //
    public function topAuthors()
    {
        $authors = Author::withCount([
            'books as total_voter' => function ($query) {
                $query->join('ratings', 'ratings.book_id', '=', 'books.id')
                    ->where('ratings.rating', '>', 5);
            }
        ])
            ->orderByDesc('total_voter')
            ->limit(10)
            ->get(['id', 'name', 'total_voter']);

        return view('pages.authors.top', [
            'authors' => $authors,
            'title' => 'Top Authors',
            'titleContent' => 'Authors',
            'li_1' => 'Authors',
            'subTitleContent' => 'Top',
        ]);
    }
}
