<?php

namespace App\Http\Controllers;
use App\Repositories\ReviewRepository;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request){

        $review = new ReviewRepository();
        if ($request->has('avg')) {
            return $review->getAVGRating($request);
        }
        return $review -> getReview($request);
    }
    public function rating($book_id){
        $rating = new ReviewRepository();
        return $rating -> getAVGRating($book_id);
    }
    public function show($book_id){
        $review = new ReviewRepository();
        return $review -> getRatingCount($book_id);
    }
    public function store(Request $request)
    {
        $review = new ReviewRepository();
        return $review -> createReview($request);
    }

}
