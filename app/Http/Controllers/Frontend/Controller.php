<?php

namespace SundaySim\Http\Controllers\Frontend;

use Illuminate\Routing\Controller as BaseController;
use SundaySim\Models\Usermeta;
use Auth;

abstract class Controller extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
        if(Auth::User()){
            $usermeta = Usermeta::where('user_id','=',Auth::User()->id)->get()->toArray();
            foreach($usermeta as $key=>$meta){
                if($meta['key'] == 'first_name'){
                    Auth::User()->setFirstName($meta['value']);
                }
                if($meta['key'] == 'last_name'){
                    Auth::User()->setLastName($meta['value']);
                }
                if($meta['key'] == 'gender'){
                    Auth::User()->setGender($meta['value']);
                }
                if($meta['key'] == 'user_image'){
                    Auth::User()->setUserImage($meta['value']);
                }
            }
        }
    }
}
