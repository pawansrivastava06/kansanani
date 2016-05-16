<?php

namespace SundaySim\Models;

use Illuminate\Database\Eloquent\Model;

class OpinionAcceptance extends Model
{
    
    protected $fillable = ['opinion_id', 'user_id', 'is_agree'];
    
    protected $dates = ['created_at','updated_at'];
    
    protected $table='opinion_acceptance';
    
    
    public function getAllOpinions() {        
        return Opinion::all()->toArray();
    }
    
    public function user() {
        return $this->hasOne('SundaySim\User', 'id', 'created_by');
    }
    
    public function category() {
        return $this->hasOne('SundaySim\Models\Categories', 'id', 'opinion_category_id');
    }
    
    public function tag() {
        return $this->hasOne('SundaySim\Models\Tag', 'id', 'tag_id');
    }
}