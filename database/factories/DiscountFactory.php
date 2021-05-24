<?php

namespace Database\Factories;

use App\Models\Discount;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiscountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Discount::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = Carbon::now()->add($this->faker->randomElement([
            '-1 week',
            '+1 week',
            '+3 days',
            '-5 days',
            '+1 month',
            '-2 months',
        ]));
        $startDate = $date->toDateString();
        $endDate = null;
        if ($this->faker->boolean(30)) {
            $endDate = $date->add($this->faker->randomElement([
                '3 days',
                '1 month',
                '7 days',
                '1 week',
                '2 weeks',
            ]))->toDateString();
        }

        return [
            'discount_start_date' => $startDate,
            'discount_end_date' => $endDate,
            'discount_price' => $this->faker->randomFloat(2, 9, 28),
        ];
    }
}
