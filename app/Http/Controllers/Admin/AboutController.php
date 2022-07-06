<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Icon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class AboutController extends Controller
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
            $about = About::select();
            return DataTables::of($about)
            ->addIndexColumn()
            ->addColumn('action', function ($query) {
                return $this->getActionColumn($query);
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('landing.abouts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $icon = Icon::get();
        return view('landing.abouts.create-edit', compact('icon'));
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
            'title' => 'required',
            'icon_id' => 'required',
            'description' => 'required'
        ]);

        $about = About::create($request->all());

        return redirect()->route('about.index')->with('status', 'Success Create About');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        $icon = Icon::get();
        return view('landing.abouts.create-edit', compact('about', 'icon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, About $about)
    {
        $this->validate($request, [
            'title' => 'required',
            'icon_id' => 'required',
            'description' => 'required'
        ]);

        $about->update($request->all());

        return redirect()->route('about.index')->with('status', 'Success update About');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
        $validate = About::count();
        if($validate == 3 || $validate < 3){
            return redirect()->route('about.index')->with('status', 'Failed delete about');
        }

        $about->delete();

        return redirect()->route('about.index')->with('status', 'Success delete about');
    }

    public function getActionColumn($data)
    {
        $editBtn = route('about.edit', $data->id);
        $deleteBtn = route('about.destroy', $data->id);
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
