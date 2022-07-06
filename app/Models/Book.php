<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'book';

    public function review()
    {
        return $this->hasMany(Review::class, 'book_id','id');
    }
    public function discount(){
        return $this->hasMany(Discount::class, 'book_id','id');
    }

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id','id');
    }
}
