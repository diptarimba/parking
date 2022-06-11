<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $admin = Admin::select();
            return DataTables::of($admin)
            ->addIndexColumn()
            ->addColumn('action', function($query){
                return $this->getActionColumn($query);
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('admins.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.create');
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
            'avatar' => 'required',
            'username' => 'required|min:5',
            'passowrd' => 'required|min:8',
            'name' => 'required'
        ]);

        $admin = Admin::create(array_merge($request->all(), [
            'avatar' => $request->hasFile('avatar') ? 'storage/'. $request->file('avatar')->storePublicly('avatar') : null,
            'password' => bcrypt($request->password)
        ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        return view('admins.create-edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        $this->validate($request, [
            'username' => 'required|min:6',
            'password' => 'sometimes',
            'name' => 'required',
            'avatar' => 'sometimes|max:1024|mimes:png,jpg,jpeg'
        ]);

        $admin->update(array_merge($request->all(), [
            'password' => $request->password ? bcrypt($request->password) : $admin->password,
            'avatar' => $request->hasFile('avatar') ? 'storage/'. $request->file('avatar')->storePublicly('avatar') : $admin->avatar,
        ]));

        return redirect()->route('admin.index')->with('status', 'Admin Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $adminCount = Admin::count();
        if($adminCount == 1){
            return redirect()->route('admin.index')->with('error', 'Can\'t delete Admin, at least 1 Admin needed!');
        }
        $admin->delete();

        return redirect()->route('admin.index')->with('status', 'Admin Delete Successfully');
    }

    public function getActionColumn($data)
    {
        $editBtn = route('admin.edit', $data->id);
        $deleteBtn = route('admin.destroy', $data->id);
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
