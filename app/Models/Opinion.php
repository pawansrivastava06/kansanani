<?php

namespace SundaySim\Models;

use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{
    
    protected $fillable = ['opinion_quote', 'opinion_description','opinion_category_id','tag_id','created_by', 'updated_by', 'created_on', 'updated_on', 'status'];
    
    protected $dates = ['created_on','updated_on'];
    
    protected $table='opinion_entity';
    
    
    public function getAllOpinions() {        
        return Opinion::all()->toArray();
    }
    
    public function user() {
        return $this->hasOne('SundaySim\User', 'id', 'created_by');
    }
    
    public function acceptance() {
        return $this->hasOne('SundaySim\Models\OpinionAcceptance', 'opinion_id', 'id');
    }
    
    public function category() {
        return $this->hasOne('SundaySim\Models\Categories', 'id', 'opinion_category_id');
    }
    
    public function tag() {
        return $this->hasOne('SundaySim\Models\Tag', 'id', 'tag_id');
    }
}