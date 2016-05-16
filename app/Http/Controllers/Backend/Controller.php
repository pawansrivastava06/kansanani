<?php

namespace SundaySim\Http\Controllers\Backend;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Redirect;

abstract class Controller extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
        $user = \Illuminate\Support\Facades\Auth::User();
        if(isset($user->user_type) && $user->user_type != 1){
            Redirect::to('frontend/dashboard')->send();
        }
    }
}
