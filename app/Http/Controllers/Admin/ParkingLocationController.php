<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParkingLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ParkingLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $parkingLocations = ParkingLocation::select();
            return DataTables::of($parkingLocations)
            ->addIndexColumn()
            ->addColumn('action', function($query){
                return $this->getActionColumn($query);
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('parkingLocations.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('parkingLocations.create-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' => 'nullable|mimes:png,jpg,jpeg|max:1024',
            'description' => 'required',
            'location_code' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        $parkingLocation = ParkingLocation::create($request->all());

        return redirect()->route('location.index')->with('status', 'Success Create Parking Location');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ParkingLocation  $parkingLocation
     * @return \Illuminate\Http\Response
     */
    public function show(ParkingLocation $parkingLocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ParkingLocation  $parkingLocation
     * @return \Illuminate\Http\Response
     */
    public function edit(ParkingLocation $parkingLocation)
    {
        return view('parkingLocations.create-edit', compact('parkingLocation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ParkingLocation  $parkingLocation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ParkingLocation $parkingLocation)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' => 'nullable|mimes:png,jpg,jpeg|max:1024',
            'description' => 'required',
            'location_code' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        $parkingLocation->update(array_merge($request->all(), [
            'image' => $request->hasFile('image') ? 'storage/' . $request->file('image')->storePublicly('landing_location') : $parkingLocation->image
        ]));

        return redirect()->route('location.index')->with('status', 'Success Update Parking Location');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ParkingLocation  $parkingLocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParkingLocation $parkingLocation)
    {
        $parkingLocation->delete();
    }

    public function getActionColumn($data)
    {
        $editBtn = route('location.edit', $data->id);
        $viewBtn = route('location.slot', $data->id);
        $deleteBtn = route('location.destroy', $data->id);
        $ident = Str::random(10);
        return
        '<a href="'.$editBtn.'" class="btn mx-1 my-1 btn-sm btn-success">Edit</a>'
        .'<a href="'.$viewBtn.'" class="btn mx-1 my-1 btn-sm btn-warning">Parking Slot</a>'
        . '<input form="form'.$ident .'" type="submit" value="Delete" class="mx-1 my-1 btn btn-sm btn-danger">
        <form id="form'.$ident .'" action="'.$deleteBtn.'" method="post">
        <input type="hidden" name="_token" value="'.csrf_token().'" />
        <input type="hidden" name="_method" value="DELETE">
        </form>';
    }

    public function getSlot($id)
    {
        $parking = ParkingLocation::whereId($id)->first();

        $data = Http::get(config('parkingslot.url'), [
            'location_name' => $parking->name
        ]);
        $response = json_decode($data->getBody()->getContents());
        return view('parkingLocations.slot', compact('response'));
    }
}
