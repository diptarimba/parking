<?php

namespace Database\Seeders;

use App\Models\ParkingHistory;
use App\Models\ParkingLocation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ParkingHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataLocation = ParkingLocation::get()->pluck('id')->random(5);
        ParkingHistory::factory()->count(500)->state(new Sequence(['parking_location_id' => $dataLocation[rand(4,0)]]))->create();
    }
}
