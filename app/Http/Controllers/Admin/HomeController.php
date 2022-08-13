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

        } else {
            // Request data by location oleh admin kalau tidak null
            if($request->location_id !== null){
                $location_request = $request->location_id;
            }
            // Location Limit untuk Admin, Admin memiliki hak seluruh lokasi
            $locationLimit = ParkingLocation::pluck('id')->toArray();
        }

        // Base builder eloquent laravel, untuk bahan dasar mencari, agar tidak ditulis berulang ulang (reusable)
        $baseBuilderParkingHistory = ParkingHistory::when(!empty($locationLimit), function($query) use ($locationLimit){
            $query->whereIn('parking_location_id', $locationLimit);
            //Apabila terdapat data date_from dan date_to, mencari data pada range waktu tertentu
        })->when(isset($request->date_from) && isset($request->date_to), function ($query) use ($request){
            $query->whereBetween('created_at', [Carbon::parse($request->date_from)->format('Y-m-d'), Carbon::parse($request->date_to)->format('Y-m-d')]);
        });

        // Base builder parking location
        $builderParkingLocation = ParkingLocation::when(!empty($locationLimit), function($query) use ($locationLimit){
            $query->whereIn('id', $locationLimit);
        });

        // Menghitung data lokasi
        $parkingLocation = $builderParkingLocation->count();
        // Mendapatkan data lokasi
        $parkingLocationList = $builderParkingLocation->get();

        if(isset($location_request)){
            $builderParkingHistory = $baseBuilderParkingHistory->clone()->when(isset($location_request), function ($query) use ($location_request){
                $query->where('parking_location_id', $location_request);
            });
            $mainParkingHistory = $builderParkingHistory->clone()->when(!isset($request->date_from) && !isset($request->date_to), function ($query){
                $query->whereDate('created_at', Carbon::now()->format('Y-m-d'));
            });
            $parkHistory = $builderParkingHistory->clone();
            $parkName = ParkingLocation::whereId($location_request)->first()->name;
        }else{
            $mainParkingHistory = $baseBuilderParkingHistory->clone()->when(!isset($request->date_from) && !isset($request->date_to), function ($query){
                $query->whereDate('created_at', Carbon::now()->format('Y-m-d'));
            });
            $parkHistory = $baseBuilderParkingHistory->clone();
            $parkName = null;
        }

        $parkingHistory = $mainParkingHistory->with('parking_location')->orderBy('created_at', 'desc')->take(10)->get();
        $parkingHistoryVisitor = $mainParkingHistory->get()->countBy('parking_location_id');
        $parkingHistoryRevenue = $mainParkingHistory->sum('amount');
        $parkingHistoryTransaction = $mainParkingHistory->count();
        if(isset($request->date_from) && isset($request->date_to)){
            $parseDate = Carbon::parse($request->date_from)->format('m/d/Y') . ' - ' . Carbon::parse($request->date_to)->format('m/d/Y');
        }else{
            $parseDate = '';
        }
        $allParkingHistory = $parkHistory->count();
        $allTurnOverParking = $parkHistory->sum('amount');
        $parkingStatistic = $parkHistory->when(!isset($request->date_from) && !isset($request->date_to), function ($query){
            $query->where('created_at','>=',Carbon::now()->subdays(15));
        })->orderBy('created_at', 'asc')->get()->groupBy(function($query) {
            return Carbon::parse($query->created_at)->format('d F Y');
        })->map(function ($query){
            return $query->sum('amount');
        });
        $parkingStatisticCount = $parkHistory->when(!isset($request->date_from) && !isset($request->date_to), function ($query){
            $query->where('created_at','>=',Carbon::now()->subdays(15));
        })->orderBy('created_at', 'asc')->get()->groupBy(function($query) {
            return Carbon::parse($query->created_at)->format('d F Y');
        })->map(function ($query){
            return $query->count();
        });
        $vehicleParking = $parkHistory->get()->groupBy('vehicle')->map(function($query){
            return $query->count();
        });
        $locationParking = $parkHistory->with('parking_location')->get()->groupBy(function($query) {
            return $query->parking_location->name;
        })->map(function($query){
            return $query->count();
        });
        $hourParking = $parkHistory->with('parking_location')->get()->groupBy(function($query) {
            return Carbon::parse($query->created_at)->format('H A');
        })->map(function($query){
            return $query->count();
        })->toArray();
        asort($hourParking);
        $hourParking = array_slice(array_reverse($hourParking, true), 0, 5, true);
        $user = User::count();
        $admin = Admin::count();
        return view('dashboard.index', compact(
            'parkName',
            'parkingLocationList',
            'parkingLocation',
            'parkingHistoryRevenue',
            'parkingHistoryTransaction',
            'user',
            'admin',
            'parseDate',
            'parkingHistory',
            'allParkingHistory',
            'allTurnOverParking',
            'parkingStatistic',
            'parkingStatisticCount',
            'vehicleParking',
            'locationParking',
            'hourParking',
        ));
    }
}
