<?php

namespace SundaySim\Models;

use Illuminate\Database\Eloquent\Model;

class Usermeta extends Model
{
    protected $table = 'users_meta';
    
    protected $guarded = 'id';
    
    protected $fillable = ['key', 'user_id', 'value'];

}
