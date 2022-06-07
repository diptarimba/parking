<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        About::factory()
            ->count(10)
            ->state(new Sequence(
                ['icon_id' => 1],
                ['icon_id' => 2],
                ['icon_id' => 3],
                ['icon_id' => 4],
                ['icon_id' => 5],
                ['icon_id' => 6],
                ['icon_id' => 7],
                ['icon_id' => 8],
                ['icon_id' => 9],
                ['icon_id' => 10],
            ))
            ->create();
    }
}
