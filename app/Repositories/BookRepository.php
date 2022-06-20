<?php

namespace App\Repositories;

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
        } else return Book::all();
    }
    // public function getBookOnSales(){
    //     return $this->query
    //     ->select('*')
    //     ->where('')
    // }
}
