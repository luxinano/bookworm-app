<?php

namespace App\Repositories;

use App\Models\Review;
use Carbon\Carbon;

class ReviewRepository
{
    public function __construct()
    {
        $this->query = Review::query();
    }

    public function getReview($request = [])
    {
        $book_id = $request['id'] ?? null;
        $perpage = $request['perpage']?? 5;
        $star = $request['star'] ?? 0;
        $sort = $request['sort'] ?? 'newtoold';
    
        $review = Review::select('*')
            ->where('review.book_id', '=', $book_id);
            
            if($star==0) {
                $review->where('rating_start','>', $star);

            }else {
                $review->where('rating_start','=', $star);
            }
            if (($sort == 'newtoold')) {
                $review->orderBy('review_date', 'desc');}
                if (($sort == 'oldtonew')) {
                    $review->orderBy('review_date', 'asc');}
        return
            $review
            ->Paginate($perpage)
            ->withQueryString();
    }

    public function getAVGRating($request = [])
    {
        $book_id = $request['id'] ?? null;
        return $this->query
            ->where('book_id', $book_id)
            ->avg('rating_start');
    }

    public function getRatingCount($book_id)
    {
        return Review::selectRaw('count(*)as star_count,book_id,rating_start')
        ->from('review')
        ->where('book_id','=', $book_id)
        ->groupBy('book_id','rating_start')->get();
    }

    public function getTopRated()
    {
        return $this->query
            ->selectRaw('*, round(avg(rating_start),1) as rating_start')
            ->groupBy('book_id')
            ->join('book', 'book.id', '=', 'review.book_id')
            ->get();
    }

    public function createReview($request){
        $function = function ($key) use ($request){
            return $request->json()->get($key);
        };

        $data=[
            'book_id' => $function('book_id'),
            'review_title' => $function('review_title'),
            'review_details' => $function('review_details'),
            'review_date' => Carbon::now(),
            'rating_start' => $function('rating_star'),
        ];
        return Review::create($data);

    }
}
