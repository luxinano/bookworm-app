<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['book_id','review_title','review_details','review_date','rating_start'];
    protected $table = 'review';

    public function book()
    {
        return $this->belongsTo(Book::class,'book_id','id');
    }
}