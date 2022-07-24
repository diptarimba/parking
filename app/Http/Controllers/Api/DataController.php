<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function receiver (Request $request)
    {
        $this->validate($request, [
            'price' => 'required',
            'parking_location_id' => 'required',
            'ref_id' => 'required',
            'pay_amount' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'signature' => 'required'
        ]);

        return response()->json([ 'data' => $request->all()]);
    }

    public function getter()
    {

    }


}
