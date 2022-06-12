<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ParkingHistory>
 */
class ParkingHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'parking_location_id' => 1,
            'ref_id' => $this->faker->regexify('[A-Za-z0-9]{15}'),
            'pay_amount' => rand(1000,4000),
            'created_at' => $this->faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d H:i:s')
        ];
    }
}
