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
        // select *,(b.book_price -d.discount_price) sub_price from discount d left join book b on d.book_id = b.id 
        // where d.discount_start_date < current_date and (d.discount_end_date > current_date or d.discount_end_date is null)
        // order by d.discount_price desc 
    }

    public function getTopRated()
    {
        $avg_rated = $this->query->selectRaw('round(avg(rating_start),1) as avg_rated , r.book_id')->from('review', 'r')->groupBy('r.book_id');
        
        return
            Book::select('book.*','r.avg_rated')
            ->joinSub($avg_rated, 'r', function ($join) {
                $join->on('book.id', '=', 'r.book_id');
            })
            ->take(8)
            ->orderBy('r.avg_rated','desc')
            ->get();
    }

    public function getFinalPrice(){
        return $this->query
        ->selectRaw('book.* ,
        (case 
            when discount.discount_start_date <= current_date 
            and (discount.discount_end_date >= current_date or discount.discount_end_date is null) then discount.discount_price
            else book.book_price
        end) as final_price')
        ->leftJoin('discount', 'book.id', '=', 'discount.book_id')->get();
    }

    public function getMostView() 
    {

    }
}
