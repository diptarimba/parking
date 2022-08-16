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
                    ['vehicle' => 'Mobil', 'parking_location_id' => 1],
                    ['vehicle' => 'Motor', 'parking_location_id' => 2],
                    ['vehicle' => 'Mobil', 'parking_location_id' => 3],
                    ['vehicle' => 'Motor', 'parking_location_id' => 4],
                )
            )->create();
    }
}
