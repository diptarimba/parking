<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct(
        public $userLogin = null,
        public $adminLogin = null
    )
    {
        $this->adminLogin = new AdminLoginController;
        $this->userLogin = new UserLoginController;

    }
    public function index()
    {
        return view('auth.common.signin');
    }

    public function store(Request $request)
    {
        if($request->type_login == 'admin')
        {
            return $this->adminLogin->login($request);
        } else {
            return $this->userLogin->login($request);
        }
    }
}
