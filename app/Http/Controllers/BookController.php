<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Repositories\BookRepository;

class BookController extends Controller
{
    public function index($id = null){
        $book = new BookRepository();
        return $book->getBookByID($id);
    }

    public function discount(){
        $discountedBook = new BookRepository();
        return $discountedBook->getDiscountedBook();
    }

    public function recommended(){
        $recommended = new BookRepository();
        return $recommended -> getTopRated();
    }
    
}
