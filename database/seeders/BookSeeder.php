<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Review;
use Faker\Factory;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::factory()->count(5)->create();
        $authors = Author::factory()->count(10)->create();
        $faker = Factory::create();
        foreach ($categories as $category) {
            foreach ($authors as $author) {
                $books = Book::factory()
                    ->count($faker->numberBetween(1, 10))
                    ->create([
                        'category_id' => $category->id,
                        'author_id' => $author->id,
                    ]);
                foreach ($books as $book) {
                    if ($faker->boolean(25)) {
                        $percentage = $faker->randomElement([0, 25, 50, 75]);
                        $discount = Discount::factory();
                        if ($percentage) {
                            $discount->create([
                                'discount_price' => number_format($book->book_price * $percentage / 100, 2),
                                'book_id' => $book->id
                            ]);
                        } else {
                            $discount->create(['book_id' => $book->id]);
                        }
                    }
                    if ($faker->boolean(40)) {
                        Review::factory()->count($faker->numberBetween(1, 10))
                            ->create([
                                'book_id' => $book->id
                            ]);
                    }
                }
            }
        }
    }
}
