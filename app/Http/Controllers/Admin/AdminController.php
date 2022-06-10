<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = Admin::all();

        return view('admins.index', compact('admin'));
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
}
