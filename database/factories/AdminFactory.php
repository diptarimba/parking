<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'username' => 'admin',
            'password' => bcrypt('12345678'),
            'avatar' => 'assets/images/placeholder/avatar/default-profile.png',
            'name' => $this->faker->words(3, true)
        ];
    }
}
