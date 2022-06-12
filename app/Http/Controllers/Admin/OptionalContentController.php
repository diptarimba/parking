<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OptionalContent;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OptionalContentController extends Controller
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
            $optionalContent = OptionalContent::select();
            return DataTables::of($optionalContent)
            ->addIndexColumn()
            ->addColumn('action', function ($query){
                return $this->getActionColumn($query);
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('landing.optionalContents.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('optional.content.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OptionalContent  $optionalContent
     * @return \Illuminate\Http\Response
     */
    public function show(OptionalContent $optionalContent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OptionalContent  $optionalContent
     * @return \Illuminate\Http\Response
     */
    public function edit(OptionalContent $optionalContent)
    {
        return view('landing.optionalContents.create-edit', compact('optionalContent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OptionalContent  $optionalContent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OptionalContent $optionalContent)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'target' => 'required',
            'menu' => 'required',
        ]);

        $optionalContent->update($request->all());

        return redirect()->route('optional.content.index')->with('status', 'Success update Optional Content');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OptionalContent  $optionalContent
     * @return \Illuminate\Http\Response
     */
    public function destroy(OptionalContent $optionalContent)
    {
        //
    }

    public function getActionColumn($data)
    {
        $editBtn = route('optional.content.edit', $data->id);
        $deleteBtn = route('optional.content.destroy', $data->id);
        $ident = substr(md5(now()), 0, 10);
        return
        '<a href="'.$editBtn.'" class="btn mx-1 my-1 btn-sm btn-success">Edit</a>';
        // . '<input form="form'.$ident .'" type="submit" value="Delete" class="mx-1 my-1 btn btn-sm btn-danger">
        // <form id="form'.$ident .'" action="'.$deleteBtn.'" method="post">
        // <input type="hidden" name="_token" value="'.csrf_token().'" />
        // <input type="hidden" name="_method" value="DELETE">
        // </form>';
    }
}
