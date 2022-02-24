<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Review
 *
 * @property int $id
 * @property int $book_id
 * @property string $review_title
 * @property string|null $review_details
 * @property string $review_date
 * @property int $rating_start
 * @method static \Database\Factories\ReviewFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Review newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Review newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Review query()
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereBookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereRatingStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereReviewDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereReviewDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereReviewTitle($value)
 * @mixin \Eloquent
 */
class Review extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'review';
    protected $fillable = [
        'user_id',
        'book_id',
        'review_title',
        'review_details',
        'review_date',
        'rating_start',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
