<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function __construct()
    {
        $this->query = Category::query();
    }

    public function getCategory(){
        return Category::select('category_name','id')->get();
    }
    
}
