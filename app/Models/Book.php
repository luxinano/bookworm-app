<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\Book
 *
 * @property int $id
 * @property int $category_id
 * @property int $author_id
 * @property string $book_title
 * @property string $book_summary
 * @property string $book_price
 * @property string|null $book_cover_photo
 * @property-read \App\Models\Author $author
 * @property-read \App\Models\Category $category
 * @method static \Database\Factories\BookFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Book newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Book newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Book query()
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereBookCoverPhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereBookPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereBookSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereBookTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereId($value)
 * @mixin \Eloquent
 */
class Book extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'book';
    protected $fillable = [
        'category_id',
        'author_id',
        'book_title',
        'book_summary',
        'book_price',
        'book_cover_photo',
    ];

    //Local Func
    public function categories()
    {
        return $this->belongsTo(Category::class);
    }

    public function authors()
    {
        return $this->belongsTo(Author::class);
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function activeDiscount()
    {
        return $this->discounts()
            ->whereDate('discount_start_date', '<=', now())
            ->where(function ($query) {
                $query->whereDate('discount_end_date', '>=', now())
                    ->orWhereNull('discount_end_date');
            });
    }

    public function scopeGetAll($query){
        return $query->$this;
    }

    //Local Scope

    public function scopeGetMinusPrice($query)
    {
        //subtrahend - minus = result
        return $query->addSelect([
            'minus' => Discount::select(DB::raw('(book_price-discount_price)'))
                ->whereColumn('book.id', 'book_id')
        ]);
    }

    public function scopeGetAvgReview($query)
    {
        return $query->addSelect([
            'avg_rate' => Review::select(DB::raw('coalesce((avg(rating_start)::float),0)'))
                ->whereColumn('book.id', 'book_id')
        ]);

    }

    public function scopeGetFinalPrice($query)
    {
        return $query->addSelect([
            'final_price' => Discount::select(DB::raw('coalesce(max(discount_price), book_price)'))
                ->whereColumn('book_id', 'book.id')
                ->whereDate('discount_start_date', '<=', now())
                ->where(function ($query) {
                    $query->whereDate('discount_end_date', '>=', now())
                        ->orWhereNull('discount_end_date');
                })
        ]);
    }

    public function scopeGetCountReview($query)
    {
        return $query->addSelect([
            'counted_review' => Review::select(DB::raw('count(*)'))
                ->whereColumn('book_id', 'book.id')
        ]);
    }

    //SHOW-OFF STAGE
    public function scopeGetRecommend($query)
    {
        // get top 8 books with most rating stars
        return $query->GetAvgReview()->GetFinalPrice()->orderByDesc('avg_rate')->orderByDesc('final_price');
    }


    public function scopeGetOnSale($query)
    {
        //top 10 books with the most discount
        return $query->whereHas('activeDiscount')->GetMinusPrice()->orderByDesc('minus');
    }

    public function scopeGetPopular($query)
    {
        //Popular: get top 8 books with most reviews - total
        //number review of a book and lowest final price
        return $query->whereHas('activeDiscount')->GetCountReview()->GetFinalPrice()->orderByDesc('counted_review')->orderBy('final_price');
    }

}
