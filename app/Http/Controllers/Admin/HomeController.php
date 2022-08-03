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
        })->whereDate('created_at', Carbon::now()->format('Y-m-d'));

        $parkingHistory = $mainParkingHistory->with('parking_location')->orderBy('created_at', 'desc')->take(10)->get();
        $parkingHistoryVisitor = $mainParkingHistory->get()->countBy('parking_location_id');
        $parkingHistoryRevenue = $mainParkingHistory->sum('amount');
        $parkingHistoryTransaction = $mainParkingHistory->count();

        $allParkingHistory = ParkingHistory::when(!empty($locationLimit), function($query) use ($locationLimit){
            $query->whereIn('parking_location_id', $locationLimit);
        })->count();
        $allTurnOverParking = ParkingHistory::when(!empty($locationLimit), function($query) use ($locationLimit){
            $query->whereIn('parking_location_id', $locationLimit);
        })->sum('amount');


        $user = User::count();
        $admin = Admin::count();
        $parkingStatistic = ParkingHistory::where('created_at','>=',Carbon::now()->subdays(15))->orderBy('created_at', 'asc')->get()->groupBy(function($d) {
            return Carbon::parse($d->created_at)->format('d F Y');
        })->map(function ($query){
            return $query->sum('amount');
        });
        // dd($parkingStatistic->toArray());

        return view('dashboard.index', compact('parkingLocation', 'parkingHistoryRevenue', 'parkingHistoryTransaction','user', 'admin', 'parkingHistory', 'allParkingHistory', 'allTurnOverParking', 'parkingStatistic'));
    }
}
