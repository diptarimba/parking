<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Activity::factory()
            ->count(4)
            ->state(new Sequence(
                ['title' => '100K', 'description'=>'Total User'],
                ['title' => '10M', 'description'=>'Total Transaction'],
                ['title' => '100+', 'description'=>'Total Location'],
                ['title' => '100K', 'description'=>'Total Visiting']
            ))
            ->create();
    }
}
