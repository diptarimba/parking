<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Feature::factory()
            ->count(4)
            ->state(new Sequence(
                ['recommendation' => '416 x 629', 'image' => '/storage/placeholder/landing/feature1.jpg'],
                ['recommendation' => '514 x 711', 'image' => '/storage/placeholder/landing/feature2.jpg'],
                ['recommendation' => '487 x 596', 'image' => '/storage/placeholder/landing/feature3.jpg'],
                ['recommendation' => '399 x 604', 'image' => '/storage/placeholder/landing/feature4.jpg'],
            ))
            ->create();
    }
}
