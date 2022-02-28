<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Http\Requests\BookRequest;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $book = DB::table('book')
            ->join('discount', 'book.id', '=', 'discount.book_id')
            ->select('book.*', 'discount.discount_price')
            ->paginate(15);
        return $book;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated_request = $request->validated();
        $book = Book::create($validated_request);

        return response(new BookResource($book), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json(['Message'=>'Deleted'],200);
    }

    public function onsale()
    {
//        $books = DB::table("book as b")
//            ->select("b.*", "d.discount_price", "b.
//             - d.discount_price as subbed_price")
//            ->join("discount as d",'d.book_id','=','b.id' )
//            ->orderBy("subbed_price","desc")
//            ->get();
//        $books = DB::table(DB::raw('book b'))
//            ->select('b.*','d.discount_price',DB::raw('(b.book_price - d.discount_price) as subbed_price'))
//            ->join(DB::raw('discount d'),'b.id','=','d.book_id')
//            ->orderByRaw('subbed_price DESC')
//            ->limit(8)
//            ->get();
        $onsale = Book::GetSubPrice()->limit(10)->get();
        return $onsale;
    }

    public function recommend()
    {
        $rec = Book::GetAvgReview()->limit(8)->get();
        return BookResource::collection($rec);
    }
}
