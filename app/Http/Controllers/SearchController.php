<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Spatie\Searchable\Search;
use Illuminate\Support\Facades\View;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $searchResults = (new Search())
            ->registerModel(Book::class, ['title'])
            ->search(trim($request->term));
        return View::make('book.search', compact('searchResults'));
    }

    public function autocomplete()
    {
        $book = Book::pluck('title');
        return response()->json($book);
    }

    public function moreinfobook($id){
        $books = Book::with(['author', 'genre','media'])->where('id', $id)->first();
        return View::make('search.moreinfo', compact('books'));
    }
}
