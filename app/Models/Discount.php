<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Discount
 *
 * @property int $id
 * @property int $book_id
 * @property string $discount_start_date
 * @property string|null $discount_end_date
 * @property string $discount_price
 * @property-read \App\Models\Book $Book
 * @method static \Database\Factories\DiscountFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discount query()
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereBookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereDiscountEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereDiscountPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereDiscountStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereId($value)
 * @mixin \Eloquent
 */
class Discount extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'discount';

    public function Book()
    {
        return $this->belongsTo(Book::class);
    }
}
