<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParkingHistory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ParkingHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $parkingHistory = ParkingHistory::with('parking_location');
            return DataTables::of($parkingHistory)
            ->addIndexColumn()
            ->addColumn('action', function($eachRow){
                return $this->getActionColumn($eachRow);
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('parkingHistories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ParkingHistory  $parkingHistory
     * @return \Illuminate\Http\Response
     */
    public function show(ParkingHistory $parkingHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ParkingHistory  $parkingHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(ParkingHistory $parkingHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ParkingHistory  $parkingHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ParkingHistory $parkingHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ParkingHistory  $parkingHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParkingHistory $parkingHistory)
    {
        //
    }

    public function getActionColumn($data)
    {
        $editBtn = route('histories.edit', $data->id);
        $deleteBtn = route('histories.destroy', $data->id);
        $ident = substr(md5(now()), 0, 10);
        return
        '<a href="'.$editBtn.'" class="btn mx-1 my-1 btn-sm btn-success">Edit</a>'
        . '<input form="form'.$ident .'" type="submit" value="Delete" class="mx-1 my-1 btn btn-sm btn-danger">
        <form id="form'.$ident .'" action="'.$deleteBtn.'" method="post">
        <input type="hidden" name="_token" value="'.csrf_token().'" />
        <input type="hidden" name="_method" value="DELETE">
        </form>';
    }
}
