<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Spatie\Searchable\Search;
use Illuminate\Support\Facades\View;
use Spatie\Searchable\ModelSearchAspect;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $searchResults = (new Search())
            ->registerModel(Book::class, ['title'])
            ->search(trim($request->term)); 

        // $searchResults = (new Search())
        //     ->registerModel(Book::class, function (ModelSearchAspect $modelSearchAspect) use ($request) {
        //         $modelSearchAspect
        //             // ->addExactSearchableAttribute('title')
        //             ->addSearchableAttribute('title')
        //             ->search($request->term);
        //     });
        // dd($searchResults);
        return View::make('book.search', compact('searchResults'));
    }

    public function autocomplete()
    {
        $book = Book::pluck('title');
        return response()->json($book);
    }
}
