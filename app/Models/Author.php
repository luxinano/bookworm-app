<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Author
 *
 * @property int $id
 * @property string $author_name
 * @property string|null $author_bio
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Book[] $books
 * @property-read int|null $books_count
 * @method static \Database\Factories\AuthorFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Author newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Author newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Author query()
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereAuthorBio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereAuthorName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereId($value)
 * @mixin \Eloquent
 */
class Author extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'author';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'author_name',
        'author_bio',
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
