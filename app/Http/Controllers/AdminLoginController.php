<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function index()
    {
        if(Auth::guard('admin')->check()){
            return redirect(route('home.index'));
        }
        return view('auth.signin');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:admins,username',
            'password' => 'required'
        ]);

        $auth = Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password], $request->filled('remember'));

        if($auth){
            return redirect()
				->intended(route('home.index'))
				->with('status','Sukses Login Sebagai Admin!');
        }else{
            return back()->withErrors('username / password anda salah!');
        }
    }

    public function logout()
    {
        if (Auth::guard('admin')->check()) {
			Auth::guard('admin')->logout();
			session()->flush();
			return redirect(route('admin.login.index'));
		}
    }

}
