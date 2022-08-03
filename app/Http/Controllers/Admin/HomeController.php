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
    public function index(Request $request){
        $user_id = Auth::guard('web')->user()->id ?? null;
        $locationLimit = [];
        if($user_id){
            $user = User::whereId($user_id)->first();
            $locationLimit = collect($user->parking_location)->pluck('id');
            if($request->location_id !== null){
                if(!in_array($request->location_id, $locationLimit->toArray()))
                {
                    return redirect()->route('user.profile.edit')->with('error', 'You don\'t have access for this location');
                }
                $location_request = $request->location_id;
            }

        }
        // dd($user_id, $locationLimit);
        $parkingLocation = ParkingLocation::when(!empty($locationLimit), function($query) use ($locationLimit){
            $query->whereIn('id', $locationLimit);
        })->count();
        $parkingLocationList = ParkingLocation::when(!empty($locationLimit), function($query) use ($locationLimit){
            $query->whereIn('id', $locationLimit);
        })->get();

        if(isset($location_request)){
            $mainParkingHistory = ParkingHistory::when(!empty($locationLimit), function($query) use ($locationLimit){
                $query->whereIn('parking_location_id', $locationLimit);
            })->when(isset($location_request), function ($query) use ($location_request){
                $query->where('parking_location_id', $location_request);
            })->whereDate('created_at', Carbon::now()->format('Y-m-d'));

            $parkHistory = ParkingHistory::when(!empty($locationLimit), function($query) use ($locationLimit){
                $query->whereIn('parking_location_id', $locationLimit);
            })->when(isset($location_request), function ($query) use ($location_request){
                $query->where('parking_location_id', $location_request);
            });
        }else{
            $mainParkingHistory = ParkingHistory::when(!empty($locationLimit), function($query) use ($locationLimit){
                $query->whereIn('parking_location_id', $locationLimit);
            })->whereDate('created_at', Carbon::now()->format('Y-m-d'));

            $parkHistory = ParkingHistory::when(!empty($locationLimit), function($query) use ($locationLimit){
                $query->whereIn('parking_location_id', $locationLimit);
            });

            $parkName = null;
        }

        $parkingHistory = $mainParkingHistory->with('parking_location')->orderBy('created_at', 'desc')->take(10)->get();
        $parkingHistoryVisitor = $mainParkingHistory->get()->countBy('parking_location_id');
        $parkingHistoryRevenue = $mainParkingHistory->sum('amount');
        $parkingHistoryTransaction = $mainParkingHistory->count();

        $allParkingHistory = $parkHistory->count();
        $allTurnOverParking = $parkHistory->sum('amount');
        $parkingStatistic = $parkHistory->where('created_at','>=',Carbon::now()->subdays(15))->orderBy('created_at', 'asc')->get()->groupBy(function($d) {
            return Carbon::parse($d->created_at)->format('d F Y');
        })->map(function ($query){
            return $query->sum('amount');
        });

        $user = User::count();
        $admin = Admin::count();
        // dd($locationLimit);

        // dd($parkingStatistic->toArray());

        return view('dashboard.index', compact('parkName','parkingLocationList','parkingLocation', 'parkingHistoryRevenue', 'parkingHistoryTransaction','user', 'admin', 'parkingHistory', 'allParkingHistory', 'allTurnOverParking', 'parkingStatistic'));
    }
}
