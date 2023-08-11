<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class ChartController extends Controller
{
    public function bookChart(){
        $book = Book::pluck('nums','title');
        return response()->json($book);
    }
}
