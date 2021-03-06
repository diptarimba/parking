<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ParkingLocation>
 */
class ParkingLocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'location_code' => 'cek',
            'description' => $this->faker->paragraph(1, true),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'image' => 'kosong',
        ];
    }
}
