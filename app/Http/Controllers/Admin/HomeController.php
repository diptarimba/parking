<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\ParkingHistory;
use App\Models\ParkingLocation;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $parkingLocation = ParkingLocation::count();
        $parkingHistory = ParkingHistory::count();
        $user = User::count();
        $admin = Admin::count();

        return view('dashboard.index', compact('parkingLocation', 'parkingHistory', 'user', 'admin'));
    }
}
