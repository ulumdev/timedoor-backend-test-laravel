<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    //
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 100);
        $search = $request->get('search');

        $books = Book::select(
            'books.id',
            'books.title',
            'categories.name as category_name',
            'authors.name as author_name',
            DB::raw('AVG(ratings.rating) as avg_rating'),
            DB::raw('COUNT(ratings.id) as total_voter')
        )
            ->join('authors', 'authors.id', '=', 'books.author_id')
            ->join('categories', 'categories.id', '=', 'books.category_id')
            ->join('ratings', 'ratings.book_id', '=', 'books.id')
            ->when($search, function ($query) use ($search) {
                $query->where('books.title', 'like', "%{$search}%")
                    ->orWhere('authors.name', 'like', "%{$search}%")
                    ->orWhere('categories.name', 'like', "%{$search}%");
            })
            ->groupBy('books.id', 'books.title', 'authors.name', 'categories.name')
            ->orderByDesc('avg_rating')
            ->paginate($perPage)
            ->withQueryString();

        return view('pages.books.index', [
            'books' => $books,
            'perPage' => $perPage,
            'search' => $search,
            'title' => 'Books List',
            'titleContent' => 'Books',
            'li_1' => 'Books',
            'subTitleContent' => 'List',
        ]);
    }
}
