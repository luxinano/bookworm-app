<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookAPIController extends Controller
{
    public function index()
    {
        $books = Book::orderBy('id', 'desc')->get();
        return response()->json($books);
        return new BookCollection($books);
    }

    public function store(StoreBookRequest $request)
    {
        $book = new Book();
        $book->category_id = 1;
        $book->author_id = 1;
        $book->book_title = $request->get('book_title');
        $book->book_summary = $request->get('book_summary');
        $book->book_price = $request->get('book_price');
        $book->save();
        return response()->json($book, 201);
    }

    /**
     * Display the specified resource.
     *
     */
    public function show($id)
    {
        $book = Book::find($id);
        //return response()->json($book);
        return new BookResource($book);

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
