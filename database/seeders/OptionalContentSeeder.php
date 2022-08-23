<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OptionalContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'title' => 'About Application',
                'description' => 'Lorem ipsum dolor sit amet',
                'target' => Str::random(10),
                'menu' => 'ABOUT',
                'default' => 'About Application'
            ],[
                'title' => 'User Activity',
                'description' => 'Lorem ipsum dolor sit amet',
                'target' => Str::random(10),
                'menu' => 'ACTIVITY',
                'default' => 'User Activity'
            ],[
                'title' => 'Location',
                'description' => 'Lorem ipsum dolor sit amet',
                'target' => Str::random(10),
                'menu' => 'LOCATION',
                'default' => 'Location'
            ],[
                'title' => 'Feedback',
                'description' => 'Lorem ipsum dolor sit amet',
                'target' => Str::random(10),
                'menu' => 'FEEDBACK',
                'default' => 'Feedback'
            ],[
                'title' => 'Contact Us',
                'description' => 'Lorem ipsum dolor sit amet',
                'target' => Str::random(10),
                'menu' => 'CONTACT',
                'default' => 'Contact Us'
            ],[
                'title' => 'Faq',
                'description' => 'Lorem ipsum dolor sit amet',
                'target' => Str::random(10),
                'menu' => 'FAQ',
                'default' => 'Faq'
            ],
        ];

        DB::table('optional_contents')->insert($data);
    }
}
