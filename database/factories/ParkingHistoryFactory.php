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
            'code' => $this->faker->regexify('[A-Za-z0-9]{15}'),
            'vehicle' => 'CAR',
            'amount' => rand(1000,8000),
            'check_in' => $this->faker->dateTimeBetween('-30 days', '-26 days')->format('Y-m-d H:i:s'),
            'check_out' => $this->faker->dateTimeBetween('-25 days', '-21 days')->format('Y-m-d H:i:s'),
            'payment_status' => 'settlement',
            'payment_type' => 'GoPay',
            'created_at' => $this->faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d H:i:s')
        ];
    }
}
