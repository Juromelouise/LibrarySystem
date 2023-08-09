<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Stock;
use DB;
use Illuminate\Http\Request;
use View;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $books = Book::with(['author','genre'])->get();
        $stocks = Stock::with(['book'])->get();

        // $stocks = DB::table('books')
        //     ->join('stocks', 'books.id', '=', 'book_id')->get();
        // return View::make('stock.index', compact('stocks'));
        return response()->json($stocks);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $books = Book::with('stock')
        //     ->whereDoesntHave('stock')
        //     ->get();
        $books = Book::with('stock')->whereDoesntHave('stock')->get();
// dd($books);
        // return view('stock.create', compact('books'));
        return response()->json($books);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $stock = new Stock;
        $stock->book_id = $request->book_id;
        $stock->stock = $request->stock;
        $stock->save();
        // return redirect()->route('stocks.index');
        return response()->json($stock);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $stock = Stock::find($id);
        // return view('stock.edit', compact('stock'));
        return response()->json($stock);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $stock = Stock::find($id);
        // $stock->book_id = $request->book_id;
        $stock->stock = $request->stock;
        $stock->save();
        // return redirect()->route('stock.table');
        return response()->json($stock);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Stock::destroy($id);
        // return back();
        return response()->json([]);
    }
}
