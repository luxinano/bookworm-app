<?php

namespace App\Repositories;

use App\Models\Review;

class ReviewRepository
{
    public function __construct()
    {
        $this->query = Review::query();
    }

    public function getReview($book_id)
    {
        return $this->query->where('book_id', $book_id)->get();
    }

    public function getAVGRating($book_id)
    {
        return $this->query
            ->where('book_id', $book_id)
            ->avg('rating_start');
    }

    public function getTopRated()
    {
        return $this->query
        ->selectRaw('*, round(avg(rating_start),1) as rating_start')
        ->groupBy('book_id')
        ->join('book', 'book.id','=','review.book_id')
        ->get();
        
    }

}
