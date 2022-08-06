<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $userRole = UserRole::select();
            return DataTables::of($userRole)
                ->addIndexColumn()
                ->addColumn('action', function ($query) {
                    return $this->getActionColumn($query);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('userRoles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('userRoles.create-edit');
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
            'name' => 'required'
        ]);

        $userRole = UserRole::create($request->all());

        return redirect()->route('roles.index')->with('status', 'Success Create User Role');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserRole  $userRole
     * @return \Illuminate\Http\Response
     */
    public function show(UserRole $userRole)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserRole  $userRole
     * @return \Illuminate\Http\Response
     */
    public function edit(UserRole $userRole)
    {
        return view('userRoles.create-edit', compact('userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserRole  $userRole
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserRole $userRole)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $userRole->update($request->all());

        return redirect()->route('roles.index')->with('status', 'Success Update User Role');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserRole  $userRole
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserRole $userRole)
    {
        $userRole->delete();

        return redirect()->route('roles.index')->with('status', 'Success Delete User Role');
    }

    public function getActionColumn($data)
    {
        $editBtn = route('roles.edit', $data->id);
        $deleteBtn = route('admin.destroy', $data->id);
        $roleBtn = route('roles.permission.edit', $data->id);
        $toggleBtn = route('roles.toggle', $data->id);
        $ident = Str::random(10);
        $valueStatus = $data->is_register ? 'Nonaktifkan' : 'Aktifkan';
        return
            '<a href="' . $roleBtn . '" class="btn mx-1 my-1 btn-sm btn-warning">Role Permission</a>'
            . '<a href="' . $editBtn . '" class="btn mx-1 my-1 btn-sm btn-success">Edit</a>'
            . '<input form="form' . $ident . '" type="submit" value="Delete" class="mx-1 my-1 btn btn-sm btn-danger">
        <form id="form' . $ident . '" action="' . $deleteBtn . '" method="post">
        <input type="hidden" name="_token" value="' . csrf_token() . '" />
        <input type="hidden" name="_method" value="DELETE">
        </form>'
            . '<input form="formToggle' . $ident . '" type="submit" value="' . $valueStatus . ' Register" class="mx-1 my-1 btn btn-sm btn-info">
        <form id="formToggle' . $ident . '" action="' . $toggleBtn . '" method="post">
        <input type="hidden" name="_token" value="' . csrf_token() . '" />
        </form>';
    }

    public function toggleRegister(UserRole $userRole)
    {
        $userRole->update([
            'is_register' => !$userRole->is_register
        ]);

        $msg = $userRole->is_register ? 'Diaktifkan' : 'Dinonaktifkan';

        return redirect()->route('roles.index')->with('status', 'User Role ' . $msg . ' pada laman register.');
    }
}
