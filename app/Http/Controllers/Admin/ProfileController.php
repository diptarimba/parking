<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function editProfile()
    {
        $user = Auth::guard('admin')->user();
        return view('admins.profile.create-edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Admin::find(Auth::guard('admin')->user()->id);
        $this->validate($request, [
            'email' => 'required',
            'name' => 'required',
            'username' => 'required',
            'avatar' => 'required|mimes:png,jpg,jpeg|max:1024',
            'phone' => 'required',
        ]);

        $user->update(array_merge($request->all(), [
            'avatar' => $request->file('avatar') ? 'storage/'. $request->file('avatar')->storePublicly('avatar') : $user->avatar
        ]));

        return redirect()->route('user.profile.edit')->with('status', 'Success update profile');
    }

    public function editPass()
    {
        return view('users.password.create-edit');
    }

    public function updatePass(Request $request)
    {
        $this->validate($request, [
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_password_confirm' => ['same:new_password']
        ]);

        $user = Admin::find(Auth::guard('admin')->user()->id);
        $user->update([
            'password' => bcrypt($request->new_password)
        ]);

        return redirect()->route('user.password.edit')->with('status', 'Success update password');
    }
}
