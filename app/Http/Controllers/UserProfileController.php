<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function editProfile()
    {
        $user = Auth::user();
        return view('users.profile.create-edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::user()->id);
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

        $user = User::find(Auth::user()->id);
        $user->update([
            'password' => bcrypt($request->new_password)
        ]);

        return redirect()->route('user.password.edit')->with('status', 'Success update password');
    }
}
