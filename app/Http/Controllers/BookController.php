<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\BookRepository;
use App\Repositories\ReviewRepository;

// sort=sale&sort_dir=desc&author=2,3&category=1&rating=5
class BookController extends Controller
{
    public function index(Request $request)
    {
        $book = new BookRepository();
        $review = new ReviewRepository();

        if ($request->has('sale')) {
            return $book->getDiscountedBook();
        }

        elseif ($request->has('recommended')) {
            return $book->getTopRated();
        }

        elseif ($request->has('popular')) {
            return $book->getMostViews();
        } else {
            return response()->json($book->getListBook($request));
        }

    }
    public function show($id)
    {
        $book = new BookRepository();
        // if ($request->has('review')) {
        //      return $review->getReview($request->get('id'));
        // }
        // if ($request->has('rating')) {
        //     return $review->getAVGRating($request->get('id'));
        // }
        return $book->getBookByID($id);
    }
}
