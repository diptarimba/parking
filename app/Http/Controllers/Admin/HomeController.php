<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\ParkingHistory;
use App\Models\ParkingLocation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $parkingLocation = ParkingLocation::count();
        $parkingHistory = ParkingHistory::with('parking_location')->whereDate('created_at', Carbon::now())->orderBy('created_at', 'desc')->take(10)->get();
        $parkingHistoryRevenue = ParkingHistory::whereDate('created_at', Carbon::now()->format('Y-m-d'))->sum('pay_amount');
        $parkingHistoryTransaction = ParkingHistory::whereDate('created_at', Carbon::now())->count();
        $user = User::count();
        $admin = Admin::count();

        return view('dashboard.index', compact('parkingLocation', 'parkingHistoryRevenue', 'parkingHistoryTransaction','user', 'admin', 'parkingHistory'));
    }
}
