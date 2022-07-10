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

    public function getListBook($request = [])
    {
        $views = Book::selectRaw('count(*) as count_reviews , r.book_id')->from('review', 'r')->groupBy('r.book_id');
        $sort = $request['sort'] ?? null;
        $final_price = $this->getFinalPrice(false);
        $avg_rated = Book::selectRaw('round(avg(rating_start),1) as avg_rated , r.book_id')
            ->from('review', 'r')
            ->groupBy('r.book_id');
        $book = $this->query
            
            ->select('book_title', 'author_name', 'book_price', 'book_cover_photo', 'final_price', 'category_id', 'avg_rated','count_reviews','book.id')
            ->selectRaw('book.book_price - final_price as sub_price')
            ->leftJoin('discount', 'book.id', '=', 'discount.book_id')
            ->leftJoin('author', 'book.author_id', '=', 'author.id')
            ->joinSub($final_price, 'f', function ($join) {
                $join->on('book.id', '=', 'f.id');
            })
            ->leftJoinSub($avg_rated, 'r', function ($join) {
                $join->on('book.id', '=', 'r.book_id');
            })
            ->leftJoinSub($views, 'c', function ($join) {
                $join->on('book.id', '=', 'c.book_id');
            });



        if (!empty($request['category'])) {
            $book->whereIn('book.category_id', explode(',', $request['category']));
        }
        if (!empty($request['author'])) {
            $book->whereIn('book.author_id', explode(',', $request['author']));
        }

        if (!empty($request['star'])) {
            $book->where('avg_rated', '>=', $request['star']);
        }

        if (($sort == 'price_desc')) {
            $book->orderBy('final_price', 'desc');
        }
        if (($sort == 'price_asc')) {
            $book->orderBy('final_price', 'asc');
        }
        if (($sort == 'sale')) {
            $book->orderBy('sub_price','desc');
        }
        if (($sort == 'popularity')) {
            $book
            ->orderbyRaw('count_reviews desc NULLS LAST')
            ->orderBy('f.final_price');
        }
        $perpage = !empty($request['perpage']) ? $request['perpage'] : 20;

        return $book

            ->orderbyRaw('discount.discount_price desc NULLS LAST')
            ->Paginate($perpage)
            ->withQueryString();
    }
    public function getBookByID($id)
    {
        $final_price = $this->getFinalPrice(false);
        if ($id != null) {
            return $this->query
            ->select('category_name','book.*','author_name','final_price')
            ->where('book.id','=',$id)
            ->joinSub($final_price, 'f', function ($join) {
                $join->on('book.id', '=', 'f.id');
            })
            ->leftJoin('category','book.category_id','category.id')
            ->leftJoin('author','book.author_id','author.id')
            ->get();
        }
    }

    public function getDiscountedBook()
    {
        $final_price = $this->getFinalPrice(false);
        return $this->query
            ->select('book_title', 'author_name', 'book_price', 'book_cover_photo', 'final_price','book.id')
            ->selectRaw('book.book_price - discount.discount_price as sub_price')
            ->take(10)
            ->joinSub($final_price, 'f', function ($join) {
                $join->on('book.id', '=', 'f.id');
            })
            ->rightJoin('discount', 'book.id', '=', 'discount.book_id')
            ->leftJoin('author', 'book.author_id', '=', 'author.id')
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
            Book::select('book.*', 'r.avg_rated', 'f.final_price')
            ->joinSub($avg_rated, 'r', function ($join) {
                $join->on('book.id', '=', 'r.book_id');
            })
            ->joinSub($final_price, 'f', function ($join) {
                $join->on('book.id', '=', 'f.id');
            })
            ->orderBy('r.avg_rated', 'desc')
            ->orderBy('f.final_price')
            ->limit(8)
            ->get();
    }


    public function getFinalPrice($not_raw_sql = true)
    {
        $final_price = Book::selectRaw('book.id ,
        (case 
            when discount.discount_start_date <= current_date 
            and (discount.discount_end_date >= current_date or discount.discount_end_date is null) 
            then discount.discount_price
            else book.book_price
        end) as final_price')
            ->leftJoin('discount', 'book.id', '=', 'discount.book_id');
        if (!$not_raw_sql) {
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
            ->orderBy('c.count_reviews', 'desc')
            ->orderBy('f.final_price')
            ->limit(8)
            ->get();
    }
}
