<?php

namespace App\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use App\Models\ParkingLocation;
use App\Models\PivotUserLocation;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LocationController extends Controller
{
    public function edit(Request $request, User $user)
    {
        if($request->ajax()){
            $parkingLocation = ParkingLocation::with(['user' => function($query) use ($user){
                return $query->select('name');
            }])->whereHas('user', function ($query) use ($user){
                $query->where('user_id', $user->id);
            });
            return DataTables::of($parkingLocation)
            ->addIndexColumn()
            ->addColumn('action', function($query){
                return $this->getActionColumn($query);
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        $parkingLocation = ParkingLocation::whereDoesntHave('user', function ($query) use ($user){
            $query->where('user_id', $user->id);
        })->get()->pluck('name', 'id');
        return view('permissions.locations.create-edit', compact('parkingLocation', 'user'));
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'location' => 'required|array',
            'location.*' => 'exists:parking_locations,id'
        ]);

        $user->parking_location()->attach($request->location);

        return back()->with('status', 'Success add location');
    }

    public function destroy(Request $request, ParkingLocation $location)
    {
        $this->validate($request, [
            'user_id' => 'required|exists:users,id'
        ]);

        $location->user()->detach($request->user_id);

        return back()->with('status', 'Success delete location');
    }

    public function getActionColumn($data)
    {
        $deleteBtn = route('user.location.destroy', $data->id);
        $user = $data->user()->first()->id;
        $ident = substr(md5(now()), 0, 10);
        return
        '<input form="form'.$ident .'" type="submit" value="Delete" class="mx-1 my-1 btn btn-sm btn-danger">
        <form id="form'.$ident .'" action="'.$deleteBtn.'" method="post">
        <input type="hidden" name="_token" value="'.csrf_token().'" />
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="user_id" value="'.$user.'"/>
        </form>';
    }
}
