<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\View;
use App\Imports\GenreImport;
use Maatwebsite\Excel\Facades\Excel;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::with('media')->get();
        
        // return View::make('genre.index', compact('genres'));
        return response()->json($genres);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return View::make('genre.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $genre = new Genre;
        $genre->genre_name = $request->genre_name;
        if ($request->document !== null) {
            foreach ($request->input("document", []) as $file) {
                $genre->addMedia(storage_path("genre/images/" . $file))->toMediaCollection("images");
                // unlink(storage_path("drivers/images/" . $file));
            }
        $genre->save();
        // return redirect()->route('genre.index');
        return response()->json($genre);
    }
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
        $genre = Genre::find($id);
        // return view('genre.edit', compact('genre'));
        return response()->json($genre);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $genre = Genre::find($id);
        $genre->genre_name = $request->genre_name;
        $genre->save();
        // return redirect()->route('genre.index');
        return response()->json($genre);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Genre::destroy($id);
        // return back();
        return response()->json([]);

    }
    public function storeMedia(Request $request)
    {
        $path = storage_path("genre/images");
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $file = $request->file("file");
        $name = uniqid() . "_" . trim($file->getClientOriginalName());
        $file->move($path, $name);

        return response()->json([
            "name" => $name,
            "original_name" => $file->getClientOriginalName(),
        ]);
    }

    public function import(Request $request){
        Excel::import(new GenreImport, $request->excel);
        return redirect()->route('genre.index');
    }
}
