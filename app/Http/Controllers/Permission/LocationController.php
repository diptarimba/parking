<?php

namespace App\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use App\Models\ParkingLocation;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function edit($id)
    {
        $parkingLocation = ParkingLocation::get();
        return view('permissions.locations.create-edit', compact('parkingLocation'));
    }

    public function update(Request $request)
    {
        dd($request);
    }
}
