<?php

namespace SundaySim;

use SundaySim\Models\Usermeta;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * constant variables
     */
    const USERS_PROFILE_FOLDER_PATH = 'themes/default/assets/uploads/users_profile/';


    
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'user_type'];

    protected $dates = ['last_login_at'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    
    public function setUserImage($value)
    {
        $this->attributes['user_image'] = $value;
    }
    
    public function setFirstName($value)
    {
        $this->attributes['first_name'] = $value;
    }
    
    public function setLastName($value)
    {
        $this->attributes['last_name'] = $value;
    }
    
    public function setGender($value)
    {
        $this->attributes['gender'] = $value;
    }
    
    public function usermeta() {
        return $this->hasMany('SundaySim\Models\Usermeta', 'user_id', 'id');
    }
    
}
