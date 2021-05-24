<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $bookCoverPhotos = [null];
        for ($i = 1; $i < 11; $i++) {
            $bookCoverPhotos[] = 'book' . $i;
        }
        return [
            'book_title' => $this->faker->sentence($this->faker->biasedNumberBetween(4, 8)),
            'book_summary' => $this->faker->realTextBetween(),
            'book_price' => $this->faker->randomFloat(2, 29, 79),
            'book_cover_photo' => $this->faker->randomElement($bookCoverPhotos),
        ];
    }
}
