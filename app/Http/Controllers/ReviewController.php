<?php

namespace App\Http\Controllers;
use App\Repositories\ReviewRepository;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function review($book_id){
        $review = new ReviewRepository();
        return $review -> getReview($book_id);
    }
}
