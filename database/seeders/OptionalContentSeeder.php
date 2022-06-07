<?php

namespace Database\Seeders;

use App\Models\OptionalContent;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
                'target' => substr(md5(Carbon::now()->subMinutes(rand(1, 55))), 0, 5),
                'menu' => 'ABOUT',
                'default' => 'About Application'
            ],[
                'title' => 'User Activity',
                'description' => 'Lorem ipsum dolor sit amet',
                'target' => substr(md5(Carbon::now()->subMinutes(rand(1, 55))), 0, 5),
                'menu' => 'ACTIVITY',
                'default' => 'User Activity'
            ],[
                'title' => 'Location',
                'description' => 'Lorem ipsum dolor sit amet',
                'target' => substr(md5(Carbon::now()->subMinutes(rand(1, 55))), 0, 5),
                'menu' => 'LOCATION',
                'default' => 'Location'
            ],[
                'title' => 'Feedback',
                'description' => 'Lorem ipsum dolor sit amet',
                'target' => substr(md5(Carbon::now()->subMinutes(rand(1, 55))), 0, 5),
                'menu' => 'FEEDBACK',
                'default' => 'Feedback'
            ],[
                'title' => 'Contact Us',
                'description' => 'Lorem ipsum dolor sit amet',
                'target' => substr(md5(Carbon::now()->subMinutes(rand(1, 55))), 0, 5),
                'menu' => 'CONTACT',
                'default' => 'Contact Us'
            ],[
                'title' => 'Faq',
                'description' => 'Lorem ipsum dolor sit amet',
                'target' => substr(md5(Carbon::now()->subMinutes(rand(1, 55))), 0, 5),
                'menu' => 'FAQ',
                'default' => 'Faq'
            ],
        ];

        OptionalContent::insert($data);
    }
}
