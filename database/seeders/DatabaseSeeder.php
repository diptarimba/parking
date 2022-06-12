<?php

namespace Database\Seeders;

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
        $this->call(SidebarMenuLabelSeeder::class);
        $this->call(SidebarMenuSingleSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(ParkingLocationSeeder::class);
        $this->call(ParkingHistorySeeder::class);
        $this->call(IconSeeder::class);
        $this->call(ZmdiSeeder::class);
        $this->call(AboutSeeder::class);
        $this->call(ContactSeeder::class);
        $this->call(FaqSeeder::class);
        $this->call(FeatureSeeder::class);
        $this->call(FeedbackSeeder::class);
        $this->call(ActivitySeeder::class);
        $this->call(OptionalContentSeeder::class);
    }
}
