<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $users = User::select();
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('action', function($eachRow){
                    return $this->getActionColumn($eachRow);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $users = User::get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userRole = UserRole::get()->pluck('id', 'name');
        return view('users.create-edit', compact('userRole'));
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
            'email' => 'required',
            'name' => 'required',
            'avatar' => 'required|mimes:png,jpg,jpeg|max:1024',
            'password' => 'required',
            'phone' => 'required',
            'phone' => 'required',
            'user_role_id' => 'required|exists:user_roles,id'
        ]);

        $user = User::create(array_merge($request->all(), [
            'avatar' => 'storage/'. $request->file('avatar')->storePublicly('avatar'),
            'password' => bcrypt($request->password)
        ]));

        return redirect()->route('user.index')->with('status', 'Success create user');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $userRole = UserRole::pluck('id', 'name');
        return view('users.create-edit', compact('user', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'email' => 'required',
            'name' => 'required',
            'avatar' => 'sometimes|mimes:png,jpg,jpeg|max:1024',
            'password' => 'sometimes',
            'phone' => 'required',
            'phone' => 'required',
            'user_role_id' => 'required|exists:user_roles,id'
        ]);

        $user->update(array_merge($request->all(), [
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'avatar' => $request->file('avatar') ? 'storage/'. $request->file('avatar')->storePublicly('avatar') : $user->avatar
        ]));

        return redirect()->route('user.index')->with('status', 'Success Update User Profile');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')->with('status', 'Success Delete User');
    }

    public function getActionColumn($data)
    {
        $editBtn = route('user.edit', $data->id);
        $deleteBtn = route('user.destroy', $data->id);
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
