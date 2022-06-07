<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Feedback>
 */
class FeedbackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'avatar' => 'assets/images/placeholder/avatar/default-profile.png',
            'name' => $this->faker->name(),
            'feedback' => $this->faker->words(3, true),
            'star_count' => rand(3,4)
        ];
    }
}
