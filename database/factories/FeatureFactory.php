<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Feature>
 */
class FeatureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'image' => 'storage/placeholder/avatar/default-profile.png',
            'title' => $this->faker->words(3, true),
            'description' => $this->faker->words(5, true),
            'recommendation' => 1
        ];
    }
}
