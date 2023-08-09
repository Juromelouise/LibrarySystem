<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\DataTables\AuthorDataTable;
use View;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::with('media')->get();
        // return View::make('author.index', compact('authors'));
        return response()->json($authors);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return View::make('author.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $author = new Author;
        $author->name = $request->name;
        $author->gender = $request->gender;
        $author->age = $request->age;
        if ($request->document !== null) {
            foreach ($request->input("document", []) as $file) {
                $author->addMedia(storage_path("author/images/" . $file))->toMediaCollection("images");
                // unlink(storage_path("drivers/images/" . $file));
            }
        $author->save();
        // return redirect()->route('author.tables');
        return response()->json($author);
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
        $author = Author::find($id);
        // return view('author.edit', compact('author'));
        return response()->json($author);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $author = Author::find($id);
        $author->name = $request->name;
        $author->gender = $request->gender;
        $author->age = $request->age;
        $author->save();
        // return redirect()->route('author.index');
        return response()->json($author);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Author::destroy($id);
        // return back();
        return response()->json([]);
    }

    public function authortable(AuthorDataTable $dataTable)
    {

        return $dataTable->render("admin.author");
    }

    public function storeMedia(Request $request)
    {
        $path = storage_path("author/images");
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
}