<?php

namespace Database\Seeders;

use App\Models\RouteLimiter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;

class RouteLimiterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataController = [
            1 => [
                'HomeController',
            ],
            2 => [
                'ParkingLocationController',
                'ParkingHistoryController'
            ],
            3 => [
                'AdminController',
                // 'UserRoleController',
                'UserController',
            ],
            4 => [
                'FeatureController',
                'FaqController',
                'AboutController',
                'FeedbackController',
                'ActivityController',
                'OptionalContentController'
            ],
        ];
        $routeCollection = Route::getRoutes();
        $data = [];

        $crudLimiter = [
            'create' => 'create',
            'store' => 'create',
            'index' => 'read',
            'update' => 'update',
            'edit' => 'update',
            'destroy'=> 'delete'
        ];

        foreach($routeCollection as $each){
            if(str_contains($each->getActionName(), 'App\\Http\\Controllers\\Admin\\')){
                //Foreach as each key
                foreach ($dataController as $key => $eachController) {
                    // foreach as each name controller per key
                    foreach($eachController as $lineController){
                        $dataEach = str_replace('App\\Http\\Controllers\\Admin\\', '', $each->getActionName());
                        if(str_contains($dataEach, $lineController)){
                            $route = $each->getName();
                            $splitRoute = explode('.', $route)[1];
                            $data[] = [
                                'route' => $route,
                                'code' => 'bx-home',
                                'name' => explode('@', $dataEach)[0],
                                'limiter' => $crudLimiter[$splitRoute] ?? null
                            ];
                        }
                    }
                }
            }
        }

        RouteLimiter::insert($data);
    }
}
