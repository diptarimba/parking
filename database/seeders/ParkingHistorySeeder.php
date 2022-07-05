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
        $dataLocation = ParkingLocation::get()->pluck('id')->random(4);
        ParkingHistory::factory()->count(500)
            ->state(
                new Sequence(
                    ['parking_location_id' => 1],
                    ['parking_location_id' => 2],
                    ['parking_location_id' => 3],
                    ['parking_location_id' => 4],
                    // ['parking_location_id' => 5],
                    // ['parking_location_id' => 6],
                    // ['parking_location_id' => 7],
                    // ['parking_location_id' => 8],
                    // ['parking_location_id' => 9],
                    // ['parking_location_id' => 10],
                )
            )->create();
    }
}
