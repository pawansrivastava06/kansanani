<?php

namespace SundaySim\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    
    protected $fillable = ['name', 'created_by', 'updated_by', 'created_on', 'updated_on', 'status'];
    
    protected $dates = ['created_on','updated_on'];
    
    protected $table='opinion_categories';
    
    
   public function getAllcategories() {        
        return Categories::all()->toArray();
    }
}
