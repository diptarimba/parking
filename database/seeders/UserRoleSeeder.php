<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Pemkot'],
            ['name' => 'Karyawan'],
        ];

        $permission = [2,3,4,5];

        foreach($data as $each){
            $userRole = UserRole::create($each);
            foreach($permission as $eachLine){
            $userRole->pivot()->create(['route_limiter_id' => $eachLine]);
            }
        }
    }
}
