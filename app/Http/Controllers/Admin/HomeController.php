<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\ParkingHistory;
use App\Models\ParkingLocation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $user_id = Auth::guard('web')->user()->id ?? null;
        $locationLimit = [];
        if($user_id){
            $user = User::whereId($user_id)->first();
            $locationLimit = collect($user->parking_location)->pluck('id');
        }
        $parkingLocation = ParkingLocation::when(!empty($locationLimit), function($query) use ($locationLimit){
            $query->whereIn('id', $locationLimit);
        })->count();

        $mainParkingHistory = ParkingHistory::when(!empty($locationLimit), function($query) use ($locationLimit){
            $query->whereIn('parking_location_id', $locationLimit);
        });

        $parkingHistory = $mainParkingHistory->with('parking_location')->whereDate('created_at', Carbon::now())->orderBy('created_at', 'desc')->take(10)->get();
        $parkingHistoryVisitor = $mainParkingHistory->whereDate('created_at',Carbon::now()->format('Y-m-d'))->get()->countBy('parking_location_id');
        $parkingHistoryRevenue = $mainParkingHistory->whereDate('created_at', Carbon::now()->format('Y-m-d'))->sum('pay_amount');
        $parkingHistoryTransaction = $mainParkingHistory->whereDate('created_at', Carbon::now())->count();

        $user = User::count();
        $admin = Admin::count();

        return view('dashboard.index', compact('parkingLocation', 'parkingHistoryRevenue', 'parkingHistoryTransaction','user', 'admin', 'parkingHistory'));
    }
}
