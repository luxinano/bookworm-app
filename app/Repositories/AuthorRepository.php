<?php

namespace App\Repositories;

use App\Models\Author;

class AuthorRepository
{
    public function __construct()
    {
        $this->query = Author::query();
    }

    public function getAuthor(){
        return Author::select('author_name','id')->get();
    }
    
}
