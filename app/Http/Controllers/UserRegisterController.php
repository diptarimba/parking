<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRole;
use App\Models\UserVerify;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserRegisterController extends Controller
{
    public function index()
    {
        $userRole = UserRole::where('is_register', 1)->get()->pluck('name','id');
        // dd($userRole);
        if(empty($userRole->toArray())){
            return redirect()->route('login.index')->with('error', 'Laman Register Tidak Tersedia');
        }
        return view('auth.user.register', compact('userRole'));
    }

    public function store(Request $request)
    {

        // Filter Phone Number
        $prePhone = substr($request->phone, 0, 3);
        $prePhoneSingle = substr($request->phone,0,1);
        $request->phone = $prePhone == '+62' ?
            $request->phone :
            (($prePhoneSingle == '0' || $prePhoneSingle == '8')?
                '+62' . substr($request->phone, 1) :
                '+' . $request->phone
        );
        // Filter Phone Number


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

        $token = Str::random(10);

        $user->user_token()->create(['token' => $token]);

        Mail::send('email.emailVerificationEmail', ['token' => $token], function($message) use($request){

            $message->to($request->email);

            $message->subject('Email Verification Mail');

        });

        return redirect()->route('login.index')->with('status', 'Berhasil registrasi, silahkan login terlebih dahulu');

    }

    public function verify($token)
    {
        $userVerify = UserVerify::whereToken($token)->first();

        if(!is_null($userVerify)){
            $user = $userVerify->user;

            if(is_null($user->email_verified_at)){
                $user->update(['email_verified_at' => Carbon::now()->format('Y-m-d H:i:s')]);
                return redirect()->route('login.index')->with('status', 'Success successfully verify, you can login now');
            }else{
                return redirect()->route('login.index')->with('status', 'Success already verified, you can login now');
            }
        }

        $message = 'Sorry your email cannot be identified.';

        return redirect()->route('user.register.index')->with('status', $message);
    }
}
