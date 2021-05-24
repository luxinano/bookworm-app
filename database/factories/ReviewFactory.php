<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $rndDate = $this->faker->randomElement([
            '-1 week',
            '-2 weeks',
            '-3 weeks',
            '-1 month',
            '-2 months',
            '-3 months',
            '-1 year',
            '-2 years',
        ]);
        $rndRate = $this->faker->randomElement([
            '1',
            '2',
            '3',
            '4',
            '5',
        ]);
        return [
            'review_title' => $this->faker->sentence($this->faker->biasedNumberBetween(3, 6)),
            'review_details' => $this->faker->paragraphs($this->faker->biasedNumberBetween(3, 6), true),
            'review_date' => $this->faker->dateTimeBetween($rndDate),
            'rating_start' => $rndRate,
        ];
    }
}
