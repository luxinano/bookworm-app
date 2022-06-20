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
    
}
