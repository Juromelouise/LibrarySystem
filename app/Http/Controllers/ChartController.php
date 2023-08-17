<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\User;
use App\Models\Genre;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function bookChart()
    {
        $book = Book::pluck('nums', 'title');
        return response()->json($book);
    }
    public function userBorrowChart()
    {
        // $borrowcount = Borrow::select('user_id')
        //     ->selectRaw('count(*) as count')
        //     ->with('user')
        //     ->groupBy('user_id')
        //     ->pluck('count', 'name');
        $borrowCounts = Borrow::select('users.name', DB::raw('count(*) as count'))
            ->join('users', 'users.id', '=', 'borrows.user_id')
            ->groupBy('users.name')
            ->pluck('count', 'name')
            ->toArray();
        return response()->json($borrowCounts);
    }

    public function mostUsedGenre()
    {
        $genre = Genre::with(['books'])->get();

        $mostUseGenre = [];

        foreach ($genre as $genre) {
            $mostUseGenre[$genre->genre_name] = count($genre->books);
        }
        Debugbar::info($mostUseGenre);

        return response()->json($mostUseGenre);
    }
}
