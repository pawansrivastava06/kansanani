<?php

namespace SundaySim\Http\Controllers\Frontend;

use SundaySim\User;
use SundaySim\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Hash;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->redirectAfterLogout = url('/');
//        $this->redirectTo = route('frontend.dashboard');

        $this->middleware('guest', ['except' => 'getLogout']);
    }
    
    public function index() {
        return view('frontend.login');
    }
    public function forgotPassword() {
        return view('frontend.password');
    }
}
