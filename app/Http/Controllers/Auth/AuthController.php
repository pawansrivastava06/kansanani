<?php

namespace SundaySim\Http\Controllers\Auth;

use SundaySim\User;
use SundaySim\Models\Usermeta;
use SundaySim\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Hash;
use Validator;

//class AuthController extends Controller implements AuthenticatableContract, CanResetPasswordContract
class AuthController extends Controller {

//    use AuthenticatesUsers;
    use AuthenticatesAndRegistersUsers,
        ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        // $this->redirectAfterLogout = route('auth.login');

        $this->redirectTo = route('frontend.dashboard');
        $this->redirectToBackend = route('backend.dashboard');

//        $this->middleware('guest', ['except' => 'getLogout']);
    }

    protected function validator(array $data) {
        if ($data['id']) {
            return Validator::make($data, [
//            'name' => 'required|max:255',
                        'first_name' => 'required|max:255',
                        'last_name' => 'required|max:255',
                        'month' => 'required|max:2', // this line right here
                        'day' => 'required|max:2', // this line right here
                        'years' => 'required|max:4', // this line right here
                        'gender' => 'required', // this line right here
//                        'user_image' => 'mimes:jpeg,jpg,png,gif|required|max:10000', // this line right here
            ]);
        }

        return Validator::make($data, [
//            'name' => 'required|max:255',
                    'first_name' => 'required|max:255',
                    'last_name' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|confirmed|min:6', // this line right here
                    'month' => 'required|max:2', // this line right here
                    'day' => 'required|max:2', // this line right here
                    'years' => 'required|max:4', // this line right here
                    'gender' => 'required', // this line right here
                    'user_image' => 'mimes:jpeg,png,gif,jpg|required|max:10000', // this line right here
        ]);
    }

    protected function create(array $data) {
        if (isset($data['id']) && $data['id']) {
            //146312404013076560_596541100502817_1103079254498004393_n.jpg
//            $imageLink = 'themes/default/assets/uploads/users_profile/146312404013076560_596541100502817_1103079254498004393_n.jpg';
//            if(file_exists($imageLink)){
//                unlink($imageLink);
//            }
//            exit;
            
            $user = User::find($data['id']);
            $user->name = $data['first_name'] . ' ' . $data['last_name'];
            $user->save();

            if (isset($_FILES["user_image"]['name']) && $_FILES["user_image"]['name']) {
                $filen = time() . $_FILES["user_image"]['name'];
                $path = User::USERS_PROFILE_FOLDER_PATH . $filen;
                move_uploaded_file($_FILES["user_image"]['tmp_name'], $path);
                
                $userMeta = Usermeta::where('user_id', $data['id'])->where('key', 'user_image')->first()->toArray();
                if(file_exists($userMeta['value'])){
                    unlink($userMeta['value']);
                }
                Usermeta::where('user_id', $data['id'])->where('key', 'user_image')->update([
                    'value' => $path,
                ]);
            }

            Usermeta::where('user_id', $data['id'])->where('key', 'first_name')->update([
                'value' => $data['first_name'],
            ]);
            Usermeta::where('user_id', $data['id'])->where('key', 'last_name')->update([
                'value' => $data['last_name'],
            ]);
            Usermeta::where('user_id', $data['id'])->where('key', 'month')->update([
                'value' => $data['month'],
            ]);
            Usermeta::where('user_id', $data['id'])->where('key', 'day')->update([
                'value' => $data['day'],
            ]);
            Usermeta::where('user_id', $data['id'])->where('key', 'years')->update([
                'value' => $data['years'],
            ]);
            Usermeta::where('user_id', $data['id'])->where('key', 'gender')->update([
                'value' => $data['gender'],
            ]);

            return $user;
        } else {
            $filen = time() . $_FILES["user_image"]['name'];
            $path = User::USERS_PROFILE_FOLDER_PATH . $filen;
            move_uploaded_file($_FILES["user_image"]['tmp_name'], $path);
            $data['user_image'] = $path;
            $user = User::create([
                        'name' => $data['first_name'] . ' ' . $data['last_name'],
                        'email' => $data['email'],
                        'user_type' => 2,
                        'password' => $data['password']
            ]);
            $userid = $user->id;
            Usermeta::create([
                'user_id' => $userid,
                'key' => 'first_name',
                'value' => $data['first_name'],
            ]);
            Usermeta::create([
                'user_id' => $userid,
                'key' => 'last_name',
                'value' => $data['last_name'],
            ]);
            Usermeta::create([
                'user_id' => $userid,
                'key' => 'month',
                'value' => $data['month'],
            ]);
            Usermeta::create([
                'user_id' => $userid,
                'key' => 'day',
                'value' => $data['day'],
            ]);
            Usermeta::create([
                'user_id' => $userid,
                'key' => 'years',
                'value' => $data['years'],
            ]);
            Usermeta::create([
                'user_id' => $userid,
                'key' => 'gender',
                'value' => $data['gender'],
            ]);
            Usermeta::create([
                'user_id' => $userid,
                'key' => 'user_image',
                'value' => $data['user_image'],
            ]);
            return $user;
        }
    }

}
