<?php

namespace App\Repositories;

use App\Models\Book;
use App\Models\Review;

class BookRepository
{

    public function __construct()
    {
        $this->query = Book::query();
    }

    public function getBookByID($id)
    {
        if ($id != null) {
            return $this->query->find($id);
        } else return $this->query
            ->leftJoin('discount', 'book.id', '=', 'discount.book_id')
            ->orderbyRaw('discount.discount_price desc NULLS LAST')->get();
    }

    public function getDiscountedBook()
    {
        return $this->query
            ->selectRaw('book.*,book.book_price - discount.disscount_price as sub_price')
            ->take(10)
            ->rightJoin('discount', 'book.id', '=', 'discount.book_id')
            ->where(function ($query) {
                $query->whereDate('discount_end_date', '>=', today())
                    ->orWhereNull('discount_end_date');
            })
            ->whereDate('discount_start_date', '<=', today())
            ->orderby('sub_price', 'desc')->get();
    }

    public function getTopRated()
    {
        $avg_rated = $this->query
        ->selectRaw('round(avg(rating_start),1) as avg_rated , r.book_id')
        ->from('review', 'r')
        ->groupBy('r.book_id');
        $final_price = $this->getFinalPrice(false);
        return
            Book::select('book.*','r.avg_rated','f.final_price')
            ->joinSub($avg_rated, 'r', function ($join) {
                $join->on('book.id', '=', 'r.book_id');
            })
            ->joinSub($final_price, 'f', function ($join) {
                $join->on('book.id', '=', 'f.id');
            })
            ->orderBy('r.avg_rated','desc')
            ->orderBy('f.final_price')
            ->limit(8)
            ->get();
    }

    public function getFinalPrice($not_raw_sql=true){
        $final_price=Book::selectRaw('book.* ,
        (case 
            when discount.discount_start_date <= current_date 
            and (discount.discount_end_date >= current_date or discount.discount_end_date is null) 
            then discount.discount_price
            else book.book_price
        end) as final_price')
        ->leftJoin('discount', 'book.id', '=', 'discount.book_id');
        if (!$not_raw_sql){
            return $final_price;
        }
        return $final_price->get();
    }

    public function getMostViews()
    {
        $views = $this->query->selectRaw('count(*) as count_reviews , r.book_id')->from('review', 'r')->groupBy('r.book_id');
        $final_price = $this->getFinalPrice(false);
       
        return
            Book::selectRaw('book.*,COALESCE(c.count_reviews, 0) as count_reviews, f.final_price')
            ->joinSub($views, 'c', function ($join) {
                $join->on('book.id', '=', 'c.book_id');
            })
            ->joinSub($final_price, 'f', function ($join) {
                $join->on('book.id', '=', 'f.id');
            })
            ->orderBy('c.count_reviews','desc')
            ->orderBy('f.final_price')
            ->limit(8)
            ->get();
    }
}
