<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;

class UserRegisterController extends Controller
{
    public function index()
    {
        $userRole = UserRole::where('is_register', 1)->get()->pluck('name','id');
        // dd($userRole);
        if(empty($userRole->toArray())){
            return redirect()->route('user.login.index')->with('error', 'Laman Register Tidak Tersedia');
        }
        return view('auth.user.register', compact('userRole'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|unique:users,username',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'name' => 'required|min:5',
            'phone' => 'required|unique:users,phone',
            'user_role_id' => 'required|exists:user_roles,id'
        ]);

        $user = User::create(array_merge($request->only('user_role_id','username', 'email', 'password', 'name', 'phone'),[
            'password' => bcrypt($request->password),
            'avatar' => 'storage/placeholder/avatar/default-profile.png'
        ]));

        return redirect()->route('user.login.index')->with('status', 'Berhasil registrasi, silahkan login terlebih dahulu');

    }
}
