<?php

namespace App\Repositories;

use App\Models\Discount;
use App\Models\Book;

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
            ->selectRaw('*,book.book_price - discount.discount_price as sub_price')
            ->take(10)
            ->rightJoin('discount', 'book.id', '=', 'discount.book_id')
            ->where( function ($query)
            {
                $query->whereDate('discount_end_date', '>=', today())
                    ->orWhereNull('discount_end_date');
            })
            ->whereDate('discount_start_date', '<=', today())
            ->orderby('sub_price', 'desc')->get();
            // select *,(b.book_price -d.discount_price) sub_price from discount d left join book b on d.book_id = b.id 
            // where d.discount_start_date < current_date and (d.discount_end_date > current_date or d.discount_end_date is null)
            // order by d.discount_price desc 
    }

    
}
