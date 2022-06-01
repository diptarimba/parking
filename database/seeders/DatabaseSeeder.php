<?php

namespace Database\Seeders;

use App\Models\ParkingHistory;
use App\Models\ParkingLocation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(AdminSeeder::class);
        // $this->call(ParkingLocationSeeder::class);
        $this->call(ParkingHistorySeeder::class);
    }
}
