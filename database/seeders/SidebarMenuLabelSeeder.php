<?php

namespace Database\Seeders;

use App\Models\SidebarMenuLabel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SidebarMenuLabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ 'name' => 'HOME'],
            [ 'name' => 'PARKING'],
            [ 'name' => 'USER'],
            [ 'name' => 'LANDING PAGE']
        ];

        SidebarMenuLabel::insert($data);

    }
}
