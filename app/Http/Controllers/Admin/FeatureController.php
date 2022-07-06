<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class FeatureController extends Controller
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
            $feature = Feature::select();
            return DataTables::of($feature)
            ->addIndexColumn($feature)
            ->addColumn('action', function($query){
                return $this->getActionColumn($query);
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('landing.features.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('landing.features.create-edit');
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
            'image' => 'required|mimes::jpeg,jpg,png|max:1024',
            'title' => 'required',
            'description' => 'required'
        ]);

        $feature = Feature::create(array_merge($request->all(),[
            'image' => $request->hasFile('image') ? $request->file('image')->storePublicly('feature') : null
        ]));

        return redirect()->route('feature.index')->with('status', 'Success Create Feature');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function show(Feature $feature)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function edit(Feature $feature)
    {
        return view('landing.features.create-edit', compact('feature'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feature $feature)
    {
        $this->validate($request, [
            'image' => 'sometimes|mimes::jpeg,jpg,png|max:1024',
            'title' => 'required',
            'description' => 'required'
        ]);

        $feature->update(array_merge($request->all(), [
            'image' => $request->hasFile('image') ? $request->file('image')->storePublicly('feature') : $feature->image
        ]));

        return redirect()->route('feature.index')->with('status', 'Success update feature');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feature $feature)
    {
        //
    }

    public function getActionColumn($data)
    {
        $editBtn = route('feature.edit', $data->id);
        $deleteBtn = route('feature.destroy', $data->id);
        $ident = Str::random(10);
        return
        '<a href="'.$editBtn.'" class="btn mx-1 my-1 btn-sm btn-success">Edit</a>'
        . '<input form="form'.$ident .'" type="submit" value="Delete" class="mx-1 my-1 btn btn-sm btn-danger">
        <form id="form'.$ident .'" action="'.$deleteBtn.'" method="post">
        <input type="hidden" name="_token" value="'.csrf_token().'" />
        <input type="hidden" name="_method" value="DELETE">
        </form>';
    }
}
