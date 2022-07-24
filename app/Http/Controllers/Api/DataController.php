<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ParkingHistory;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function receiver (Request $request)
    {
        try {
        $this->validate($request, [
            'parking_location_id' => 'required',
            'code' => 'required',
            'vehicle' => 'required',
            'amount' => 'required',
            'check_in' => 'required',
            'check_out' => 'required',
            'payment_status' => 'required',
            'payment_type' => 'required',
            // 'signature' => 'required'
        ]);



        ParkingHistory::create($request->only([
            'parking_location_id',
            'code',
            'vehicle',
            'amount',
            'check_in',
            'check_out',
            'payment_status',
            'payment_type',
        ]));


            return response()->json([ 'message' => 'success', 'data' => $request->all()]);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'failed', 'data' => $e->getMessage()]);
        }
    }

    public function getter()
    {

    }


}
