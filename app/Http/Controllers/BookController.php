<?php

namespace App\Http\Controllers;

use App\DataTables\BookDataTable;
use App\DataTables\StockDataTable;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::with(['author','genre'])->get();
        // $books = DB::table('authors')
        //     ->join('books', 'authors.id', '=', 'books.author_id')
        //     ->join('genres', 'books.genre_id', '=', 'genres.id')
        //     ->get();
        // dd($books);
        // return View::make('book.index', compact('books'));
        return response()->json($books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all();
        $genres = Genre::all();
        // return View::make('book.create', compact('authors', 'genres'));
        return response()->json(["authors"=> $authors, "genres" => $genres]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'title' => 'required|min:5|max:20',
        //     'author_id' => 'required',
        //     'genre_id' => 'required',
        //     'date_released' => 'required',
        //     'imgpath' => 'required|image|mimes:jpeg,jpg,png,gif',
        // ]);

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        $book = new Book;

        // if ($request->file()) {
        //     $fileName = time() . '_' . $request->file('imgpath')->getClientOriginalName();

        //     $path = Storage::putFileAs(
        //         'public/images',
        //         $request->file('imgpath'),
        //         $fileName
        //     );
        //     $book->imgpath = '/storage/images/' . $fileName;
        // }

        $book->title = $request->title;
        $book->author_id = $request->author_id;
        $book->genre_id = $request->genre_id;
        $book->date_released = $request->date_released;
        $book->nums = "0";
        $book->imgpath = "default";
        $book->save();

        // return redirect()->route('books.table');
        return response()->json($book);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $books = Book::with(['author','genre'])->where('id', $id)->first();
        // $book = DB::table('authors as a')
        //     ->join('books as b', 'a.id', '=', 'b.author_id')
        //     ->join('genres as g', 'b.genre_id', '=', 'g.id')
        //     ->where('b.id', $id)
        //     ->first();

        $authors = Author::where('id', '<>', $books->author->id)->get();
        $genres = Genre::where('id', '<>', $books->genre->id)->get();

        // return View::make('book.edit', compact('book', 'authors', 'genres'));
        return response()->json(["books"=> $books, "authors"=> $authors, "genres"=> $genres]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $validator = Validator::make($request->all(), [
        //     'title' => 'required|min:5|max:20',
        //     'author_id' => 'required',
        //     'genre_id' => 'required',
        //     'date_released' => 'required',
        //     'imgpath' => 'image|mimes:jpeg,jpg,png,gif',
        // ]);

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        $book = Book::find($id);

        // if ($request->file()) {
        //     $fileName = time() . '_' . $request->file('imgpath')->getClientOriginalName();

        //     $path = Storage::putFileAs(
        //         'public/images',
        //         $request->file('imgpath'),
        //         $fileName
        //     );
        //     $book->imgpath = '/storage/images/' . $fileName;
        // }

        $book->title = $request->title;
        $book->author_id = $request->author_id;
        $book->genre_id = $request->genre_id;
        $book->date_released = $request->date_released;
        $book->imgpath = "pogi si dave";
        $book->save();

        // return redirect()->route('book.index');
        return response()->json($book);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Book::destroy($id);
        // return back();
        return response()->json([]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $books = Book::select('books.*', 'authors.name as author_name', 'genres.genre_name')
            ->leftJoin('authors', 'books.author_id', '=', 'authors.id')
            ->leftJoin('genres', 'books.genre_id', '=', 'genres.id')
            ->where('books.title', 'like', '%' . $query . '%')
            ->orWhere('authors.name', 'like', '%' . $query . '%')
            ->orWhere('genres.genre_name', 'like', '%' . $query . '%')
            ->orWhere('date_released', 'like', '%' . $query . '%')
            ->get();

        return view('book.search', ['books' => $books, 'query' => $query]);
    }

    public function booktable(BookDataTable $dataTable)
    {
        return $dataTable->render("admin.book");
    }

    public function stocktable(StockDataTable $dataTable)
    {
        return $dataTable->render("admin.stock");
    }
}
